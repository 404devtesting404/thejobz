<?php

namespace App\Http\Controllers\Admin;


use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\GoldRate;
use App\Model\GoldOverallRate;
use App\Model\Comment;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use File;
use Carbon\Carbon;
// use DB;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Services\GoogleIndexingService;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler; // ✅ ye wala chahiye

class GoldRateController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

     public function index(Request $req)
    {
        return view('gold_rates'); // we'll create resources/views/gold/page.blade.php
    }

    public function apiOverall()
    {
        $latest = GoldOverallRate::orderBy('created_at','desc')->first();
        if (!$latest) {
            return response()->json([]);
        }
        return response()->json($latest);
    }

        // API: all city rates (latest for each city)
    public function apiCities()
    {
       $cities = GoldRate::select('city','symbol','bidding','asking','updated_at')
        ->whereIn('id', function($q) {
            $q->selectRaw('MAX(id)')
            ->from('gold_rates')
            ->groupBy('city');
        })
        ->orderBy('city')
        ->get();
        return response()->json(['data' => $cities]);
    }

        // API: last 10 days data for chart (group by date, take avg 1 tola)

   public function apiLast10()
    {
        $rows = GoldOverallRate::orderBy('created_at','desc') // latest first
    ->take(10)
    ->get()
    ->reverse() // ab oldest → latest
    ->values();
        
        $labels = $rows->map(fn($r) => $r->created_at->format('d-m-Y'))->toArray();
        $data = $rows->map(fn($r) => (float)$r->tola1_24k)->toArray();
        
        $raw = $rows->map(function ($r) {
            return [
                'date' => $r->created_at->format('d-m-Y'),
                'tola1_24k' => $r->tola1_24k,
                'gram10_24k' => $r->gram10_24k,
                'gram1_24k' => $r->gram1_24k,
            ];
        })->toArray();
        
        return response()->json([
            'labels' => $labels,
            'data'   => $data,
            'raw'    => $raw,
        ]);

    }



    // Comments
    public function apiComments()
    {
        $comments = Comment::latest()->take(50)->get();
        return response()->json($comments);
    }

    public function postComment(Request $req)
    {
        $req->validate(['comment'=>'required']);
        $c = Comment::create([
            'name' => $req->name ?? 'Guest',
            'comment' => $req->comment
        ]);
        return response()->json(['success'=>true, 'comment'=>$c]);
    }

    // Chat store & analytics
    public function postChat(Request $req)
    {
        $message = $req->message ?? '';
        $city = null;
        foreach (['Karachi','Lahore','Islamabad','Quetta','Peshawar'] as $c) {
            if (stripos($message,$c) !== false) { $city = $c; break; }
        }
        ChatQuery::create(['city'=>$city,'message'=>$message]);
        $reply = 'Sorry, I only show gold rates for Karachi, Lahore, Islamabad, Quetta, Peshawar.';
        if ($city) {
            $rate = GoldRate::where('city','like',"%{$city}%")->latest()->first();
            if ($rate) {
                $reply = "{$city} Gold Rate: Bidding {$rate->bidding} | Asking {$rate->asking}";
            } else {
                $reply = "{$city} rate not found in DB.";
            }
        }
        return response()->json(['reply'=>$reply]);
    }

    public function apiChatAnalytics()
    {
        $counts = ChatQuery::selectRaw('city, count(*) as total')
                    ->whereNotNull('city')
                    ->groupBy('city')
                    ->pluck('total','city');

        // ensure keys for main cities exist
        $cities = ['Karachi','Lahore','Islamabad','Quetta','Peshawar'];
        $result = [];
        foreach ($cities as $c) {
            $result[$c] = isset($counts[$c]) ? (int)$counts[$c] : 0;
        }

        return response()->json($result);
    }
// -------------------------------------------------------------------

    public function getGoldRate()
    {
        $response = Http::withHeaders(['X-API-KEY' => env('GOLDPRICEZ_API_KEY'),])->get('https://goldpricez.com/api/rates/currency/PKR/measure/tola-pakistan');
        if ($response->successful()) {
            $raw = $response->json();

            // Debugging ke liye dekh lo
            // dd($raw);

            // API response JSON decode karna
            if (is_string($raw)) {
                $raw = json_decode($raw, true);
            }

            $ounceInPKR = $raw['ounce_in_pkr'] ?? null;

            $goldPerTola = null;
            if (!empty($ounceInPKR)) {
                $goldPerTola = $ounceInPKR / 2.667;
            }

            return response()->json([
                'gold_rate_per_tola' => $goldPerTola ? round($goldPerTola, 2) : null,
                'raw' => $raw
            ]);
        }
    }



    public function scrape_gold()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://gold.pk/');

        $text = $crawler->filter('body')->text();

        // ==============================
        // 1. Table Data (Cities & Rates)
        // ==============================
        $data = [];

        if ($crawler->filter('.progress-table .table-row')->count() > 0) {
            $rows = $crawler->filter('.progress-table .table-row');

            $rows->each(function (Crawler $row) use (&$data) {

                $city    = $row->filter('.column30')->count() ? trim($row->filter('.column30')->text()) : null;
                $symbol  = $row->filter('.column15')->count() ? trim($row->filter('.column15')->text()) : null;
                $bidding = $row->filter('.column20')->count() > 0 ? trim($row->filter('.column20')->eq(0)->text()) : null;
                $asking  = $row->filter('.column20')->count() > 1 ? trim($row->filter('.column20')->eq(1)->text()) : null;

                // Filter only "Gold Rate in ..." cities
                if ($city && str_contains($city, 'Gold Rate in')) {
                    $data[] = [
                        'city'    => $city,
                        'symbol'  => $symbol,
                        'bidding' => $bidding,
                        'asking'  => $asking,
                    ];
                    // ==============================
                    // Save to Database
                    // ==============================
                    // GoldRate::updateOrCreate(
                     GoldRate::Create(
                         [
                             'city'    => $city,
                             'symbol' => $symbol,
                             'bidding' => str_replace(',', '', $bidding),
                             'asking'  => str_replace(',', '', $asking),
                         ]
                     );
                }
            });
        }
        // dd($data);

        // ==============================
        // 2. Regex Data (24K, 10g, 1g)
        // ==============================
        preg_match('/Rs\.\s*([\d,]+\.\d+)\s*24 Karat Gold Rate \(1 Tola\)/', $text, $tola);
        preg_match('/Rs\.\s*([\d,]+\.\d+)\s*24 Karat Gold Rate \(10 Gram\)/', $text, $gram10);
        preg_match('/Rs\.?\s*([\d,]+\.\d+)\s*24 Karat Gold Rate \(1 Gram\)/', $text, $gram1);

        $rates = [
            '1 Tola 24 Karat Gold'  => isset($tola[1]) ? str_replace(',', '', $tola[1]) : null,
            '10 Gram 24 Karat Gold' => isset($gram10[1]) ? str_replace(',', '', $gram10[1]) : null,
            '1 Gram 24 Karat Gold'  => isset($gram1[1]) ? str_replace(',', '', $gram1[1]) : null,
        ];
        // GoldOverallRate::updateOrCreate(
        GoldOverallRate::Create(
            // ['id' => 1], // always update first row
            [
                'tola1_24k'  => $rates['1 Tola 24 Karat Gold'],
                'gram10_24k'=> $rates['10 Gram 24 Karat Gold'],
                'gram1_24k' => $rates['1 Gram 24 Karat Gold'],
            ]
        );
        // ==============================
        // 3. Final JSON Response
        // ==============================
        return response()->json([
            'success' => !empty($rates['1 Tola 24 Karat Gold']),
            'rates'   => $rates,
            'cities'  => $data,
        ]);
    }

    public function getOverallGoldRates()
    {
        return datatables(\DB::table('gold_overall_rates'))->make(true);
    }

    public function getCityGoldRates()
    {
        return datatables(\DB::table('gold_rates'))->make(true);
    }


}
