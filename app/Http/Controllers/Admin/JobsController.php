<?php

namespace App\Http\Controllers\Admin;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Banner;
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

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $total_jobs = DB::table('jobs')
            ->select('jobs.id', 'jobs.img')
            ->where('jobs.img', '!=', null)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $total_jobs_with_out_imgs = DB::table('jobs')
            ->select('jobs.id', 'jobs.img')
            ->where('jobs.img', '=', null)
            ->where('jobs.is_deleted', '=', 0)
            ->count();

        $total_jobs_img_file_exists = DB::table('jobs')
            ->select('jobs.id', 'jobs.img', 'jobs.paper_name')
            ->where('jobs.is_deleted', '=', 0)
            ->get();

        $jobs_with_out_img = 0;
        if (count($total_jobs_img_file_exists) > 0) {
            foreach ($total_jobs_img_file_exists as $job) {
                // $imagePath = asset('public/img/') . '/' . $job->paper_name . '/' . $job->img;
                // $imagePath = public_path('img/' . '/' . $job->img);
                // $imagePath = asset('storage/app/public/jobs/' . $job->img);
                $imagePath = storage_path('app/public/jobs/' . $job->img);
                if (!file_exists($imagePath)) {
                    // dd($imagePath);
                    $jobs_with_out_img++;
                }
            }
        }
        $total_jobs_with_out_img = $total_jobs_with_out_imgs + $jobs_with_out_img;
        // dd($total_jobs_with_out_img);

        $three_month_old_jobs = DB::table('jobs')
            ->select('jobs.id', 'jobs.posted', 'jobs.title', 'jobs.paper_name')
            ->where('posted', '<=', Carbon::now()->submonths(3)->toDateTimeString())->count();


        $jobs =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'job_city.id', '=', 'jobs.city')
            ->select('jobs.id', 'jobs.link', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            // ->whereYear('jobs.posted', '=', 2022)
            ->where('jobs.img', '!=', null)
            ->where('jobs.is_deleted', '=', 0)
            ->orderBy('jobs.id', 'desc')
            ->paginate(10);

        // posted

        return view('admin.jobs.index', compact('jobs', 'total_jobs', 'total_jobs_with_out_img', 'three_month_old_jobs'));
    }


    public function images()
    {
        $jobs =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'job_city.id', '=', 'jobs.city')
            ->select('jobs.id', 'jobs.link', 'jobs.img', 'jobs.slug', 'jobs.meta_description', 'jobs.meta_keywords', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            // ->whereYear('jobs.posted', '=', 2022)
            ->where('jobs.img', '!=', null)
            ->where('jobs.is_deleted', '=', 0)
            ->where('jobs.status', '=', 0)
            ->orderBy('jobs.id', 'desc')
            ->get();

        // dd($jobs);
        return view('admin.jobs.images', compact('jobs'));
    }
    
         public function auto()
    {
        $jobs =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'job_city.id', '=', 'jobs.city')
            ->select('jobs.id', 'jobs.link', 'jobs.img', 'jobs.slug', 'jobs.meta_description', 'jobs.meta_keywords', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            // ->whereYear('jobs.posted', '=', 2022)
            ->where('jobs.img', '!=', null)
            ->where('jobs.is_deleted', '=', 0)
            ->where('jobs.ai_deleted', '=', 0)
            ->where('jobs.status', '=', 0)
            ->orderBy('jobs.id', 'desc')
            ->get();


        return view('admin.jobs.auto', compact('jobs'));
    }
    
        public function content_update()
    { 
        $jobs =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'job_city.id', '=', 'jobs.city')
            ->select('jobs.id', 'jobs.link', 'jobs.img', 'jobs.slug', 'jobs.meta_description', 'jobs.meta_keywords', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city') 
            ->where('jobs.img', '!=', null)
            ->whereRaw('jobs.is_deleted = 0')
            ->whereNotNull('jobs.title_scraper') // 👈 yeh line add ki gayi hai
            ->whereRaw('jobs.title_scraper = jobs.title')
            ->orderBy('jobs.id', 'desc')
            ->get();

        // dd($jobs);
        return view('admin.jobs.content_update', compact('jobs'));
    }
    
        public function alljobs()
    {
        $jobs =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'job_city.id', '=', 'jobs.city')
            ->select('jobs.id', 'jobs.link', 'jobs.facebook','jobs.img', 'jobs.slug', 'jobs.meta_description', 'jobs.meta_keywords', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            // ->whereYear('jobs.posted', '=', 2022)
            ->where('jobs.img', '!=', null)
            ->where('jobs.is_deleted', '=', 0)
            ->where('jobs.status', '=', 1)
            ->whereNotNull('jobs.title_scraper') // 👈 yeh line add ki gayi hai
            ->whereRaw('jobs.title_scraper != jobs.title')
            ->orderBy('jobs.id', 'desc')
            ->get();

        // dd($jobs);
        // return view('admin.jobs.images', compact('jobs')); 
        return view('admin.jobs.alljobs', compact('jobs')); 
    }
    
    public function updatefb(Request $request)
    {
        $job = DB::table('jobs')->where('id', $request->id)->first();
        $userId = Auth::id();
        if ($job) {
            DB::table('jobs')
                ->where('id', $request->id)
                ->update([
                    'facebook' => 1, 
                ]);

            return response()->json(['success' => true, 'message' => 'Job updated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Job not found!'], 404);
        }
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'experience' => 'required|max:65535',
            'salary' => 'required|max:65535',
            'salary_upto' => 'required|max:65535',
            'details' => 'required|max:65535',


            'images' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ], [
            'images.required' => 'Image is required!',
        ]);

        // dd($request->all());
        if ($request->file('images')) {
            $images = time() . '.' . $request->images->extension();
            $request->images->move(public_path('storage/jobs/'), $images);
        }

        DB::table('jobs')->insert([
            'user_id' => auth('admin')->user()->id,
            'title' => $request->title,
            'type' => $request->type,
            'location' => $request->location,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'salary_upto' => $request->salary_upto,
            'details' => $request->details,
            'images' => $images
        ]);

        Toastr::success('Job added successfully!');
        return back();
    }

    public function status(Request $request)
    {
        if ($request->ajax()) {
            DB::table('jobs')
                ->where('id', $request->id)
                ->update(['status' => DB::raw($request->status)]);
            $data = $request->status;
            return response()->json($data);
        }
    }

    public function edit(Request $request)
    {
        $data =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'job_city.id', '=', 'jobs.city')
            ->select('jobs.id', 'jobs.view', 'jobs.img', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_city.name as city')
            ->where('jobs.id', $request->id)
            ->first();
        // return response()->json($data);
        $data = [
            'id' => $data->id,
            'paper_name' => $data->paper_name,
            'title' => $data->title,
            'department' => $data->department,
            'city' => $data->city,
            // 'img' => 'public/img/'.$data->paper_name.'/'.$data->img,
            'img' =>  asset('public/img') . '/' . $data->img,
            'posted' => $data->posted,
            'view' => $data->view,
        ];
        return response()->json(array('data' => $data), 200);
    }

    public function update(Request $request)
    {
        // dd( $request->all() );
        $request->validate([
            'title' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'experience' => 'required|string|max:100',
            'salary' => 'required|string|max:100',
            'salary_upto' => 'required|max:65535',
            'images' => 'image|mimes:jpeg,png,jpg|max:5000',
        ]);

        if ($request->file('images')) {
            $images = time() . '.' . $request->images->extension();
            $request->images->move(public_path('storage/jobs/'), $images);
            $update = [
                'title' => $request->title,
                'location' => $request->location,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'salary_upto' => $request->salary_upto,
                'details' =>  $request->details,
                'images' => $images
            ];
            DB::table('jobs')->where('id', $request->id)->update($update);
            Toastr::success('Job updated successfully.');
            return back();
        }

        $update = [
            'title' => $request->title,
            'location' => $request->location,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'salary_upto' => $request->salary_upto,
            'details' =>  $request->details
        ];
        DB::table('jobs')->where('id', $request->id)->update($update);
        Toastr::success('Job updated successfully.');
        return back();
    }

    public function delete(Request $request)
    {

        $r = DB::table('jobs')->where('id', '=', $request->id)->first();

        if (!empty($r->images)) {
            $r_img_path = "public/img/$r->images";
            if (File::exists($r_img_path)) {
                File::delete($r_img_path);
            }
        }

        DB::table('jobs')->delete($request->id);
        // Toastr::success('Restaurant removed successfully!');
        return redirect()->back()->with('message', 'Job removed successfully!');
        // return back();
    }

    public function deleteJob($id)
    {
        try {
            $r = DB::table('jobs')->where('id', '=', $request->id)->first();

            if (!empty($r->images)) {
                $r_img_path = "public/img/$r->images";
                if (File::exists($r_img_path)) {
                    File::delete($r_img_path);
                }
            }

            DB::table('jobs')->delete($id);
            // Toastr::success('Restaurant removed successfully!');
            return redirect()->back()->with('message', 'Job removed successfully!');
            // return back();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the job!',
            ], 500);
        }
    }


    public function delete_two(Request $request)
    {

        // dd($request->all());
        // $image_path = "/images/filename.ext";  // Value is not URL but directory file path
        $r_img_path = "public/img/$request->img";

        if (File::exists($r_img_path)) {
            File::delete($r_img_path);
        }
        $update = [
            'is_deleted' => 1,
        ];
        DB::table('jobs')->where('id', $request->id)->update($update);

        // $r = DB::table('jobs')->where('id', '=', $request->id)->first();
        // if (!empty($r->images)) {
        //     $r_img_path = "public/img/$r->images";
        //     if (File::exists($r_img_path)) {
        //         File::delete($r_img_path);
        //     }
        // }
        // DB::table('jobs')->delete($request->id);
        // Toastr::success('Restaurant removed successfully!');
        return redirect()->back()->with('message', 'Job removed successfully!');
        // return back();
    }
    
    // public function updatetwo(Request $request)
    // {  
    //     $job = DB::table('jobs')->where('id', $request->id)->first();
    //     $userId = Auth::id();
    //     if ($job) {
    //         DB::table('jobs')
    //             ->where('id', $request->id)
    //             ->update([
    //                 'title' => $request->title,
    //                 'content_update_by' => $userId,
    //                 'content_update_date' => now(),
    //                 'meta_description' => $request->meta_description,
    //                 'meta_keywords' => $request->meta_keywords,
    //             ]);

    //         return response()->json(['success' => true, 'message' => 'Job updated successfully!']);
    //     } else {
    //         return response()->json(['success' => false, 'message' => 'Job not found!'], 404);
    //     }
    // }
    
    public function updatetwo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $job = DB::table('jobs')->where('id', $request->id)->first();
        $userId = Auth::id();
        if($job->attempt > 4){
              DB::table('jobs')
                ->where('id', $request->id)
                ->update([
                    'ai_deleted' => 1,
                ]);
        }
         DB::table('jobs')
                ->where('id', $request->id)
                ->update([
                    'content_update_date' => now(),
                    'attempt' => $job->attempt + 1,
                ]);

        // dd($job);

        if ($job->title == $request->title) {
             return response()->json(['error' => false, 'message' => 'Privice title is same as now!'], 404);
        }
        if ($job) {
             if ($job->is_watermarked == 0) {
             $watermark = Image::make(public_path('Watermark.png'))->opacity(20);
             $imagePath = storage_path('app/public/jobs/' . $job->img);
                if (file_exists($imagePath)) {
                    $image = Image::make($imagePath);
                    $image->insert($watermark, 'center');
                    // $savePath = public_path('images/test/' . $job->img);
                    $savePath = storage_path('app/public/jobs/' . $job->img);
                    $image->save($savePath, 100);
                    DB::table('jobs')->where('id', $job->id)->update(['is_watermarked' => 1]);
                }
            }

            DB::table('jobs')
                ->where('id', $request->id)
                ->update([
                    'title' => $request->title,
                    'content_update_by' => $userId,
                    'content_update_date' => now(),
                    'meta_description' => $request->meta_description,
                    'meta_keywords' => $request->meta_keywords,
                    'status' => 1,
                ]);

            return response()->json(['success' => true, 'message' => 'Job updated successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Job not found!'], 404);
        }
    }
    
        public function generate(Request $request)
    {
      $title = $request->input('title');
      $description = $request->input('meta_description');
      $keywords = $request->input('meta_keywords');

        // ✅ Compose dynamic prompt from input
         //    $prompt = "Write me an unique SEO friendly content on the following data. The article should be human friendly, it should not seem like it is written by AI, and should be 100% unique Title, Description and Keywords and 0% plagiarism free, and optimized to rank in Google. Write unique only Title, Description, and Keywords in a clean and readable format title must be unique.\n\n" .
         //             "<title>$title</title>\n" .
          //             "<meta name=\"description\" content=\"$description\">\n" .
         //             "<meta name=\"keywords\" content=\"$keywords\">";
            $prompt = "Write me an unique SEO friendly content on the following data. The article should be human friendly, it should not seem like it is written by AI, and should be 100% unique Title, Description and Keywords and 0% plagiarism free, and optimized to rank in Google. Write unique only Title, Description, and Keywords in a clean and readable format title must be unique.\n\n Return the output in this exact format:

            Title: [your title here]
            Description: [your description here]
            Keywords: keyword1, keyword2, keyword3

            Only give the output in the above format.

            Input:
            <title>$title</title>
            <meta name=\"description\" content=\"$description\">
            <meta name=\"keywords\" content=\"$keywords\">";

 
    //   $apiKey = 'RUnRiSZkvpEkNhmi6BZ3wFFGscNQWcisWktSfYIf';
       $apiKey = '0bLcMqEZTPWOS66uTbU427VHhQkhCsXZXLui00Yn';
      // $apiKey = '7z11iKYu34aCn288nBD960r9c02MEDuTuHnqjYhU';
        //  $apiKey ="DjJMlyKOa4mtyTUDaIEr9qlSUnRc8j1EHYFIPZkq";
       $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.cohere.ai/generate', [
            'model' => 'command',
            'prompt' => $prompt,
            'max_tokens' => 500,
            'temperature' => 0.9,
        ]);

        // ✅ Return response as JSON
        return response()->json($response->json());
    }

    public function generate11(Request $request)
    {
        $title = $request->input('title');
        $description = $request->input('meta_description');
        $keywords = $request->input('meta_keywords');

        $date = now()->toDateString();
        $randomizer = uniqid();

        $prompt = "Generate unique and SEO-friendly content based on the following job post. Provide only plain text output — do not include any HTML tags. Format must be:\n\n" .
                "Title: ...\nDescription: ...\nKeywords: ...\n\n" .
                "Details:\n" .
                "Job Title: $title\n" .
                "Description: $description\n" .
                "Keywords: $keywords\n" .
                "Location: Ahmedpur East\n" .
                "Department: Anhar Department\n" .
                "Date: $date\n" .
                "Session: $randomizer";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('COHERE_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.cohere.ai/generate', [
            'model' => 'command',
            'prompt' => $prompt,
            'max_tokens' => 500,
            'temperature' => 0.7,
        ]);

        return response()->json($response->json());
    }

    public function console(Request $request)
    {


        $jobs = DB::table('jobs')
            ->select('jobs.id', 'jobs.link', 'jobs.img', 'jobs.slug', 'jobs.title','jobs.content_update_type')
            ->whereNotNull('jobs.img')  // Ensuring img is not null
            ->whereColumn('jobs.title', '!=', 'jobs.title_scraper') // Comparing columns correctly
            ->where('jobs.is_deleted', '=', 0)
            ->where('jobs.status', '=', 1)
            ->orderBy('jobs.id', 'desc')
            ->limit(50)
            ->get();

        // $departmentCounts = DB::table('jobs')
        //     ->select('*', DB::raw('count(*) as total'))
        //     ->whereNotNull('jobs.img')
        //     ->whereColumn('jobs.title', '!=', 'jobs.title_scraper')
        //     ->where('jobs.is_deleted', '=', 0)
        //     ->where('jobs.status', '=', 1)
        //     ->groupBy('department')
        //     ->orderByDesc('total')
        //     ->get();
        $departmentCounts = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')  // Join with job_department table
            ->select('job_department.name as department_name','job_department.slug as dept_slug','jobs.*', DB::raw('count(*) as total')) // Select department name and count
            ->whereNotNull('jobs.img')
            ->whereColumn('jobs.title', '!=', 'jobs.title_scraper')
            ->where('jobs.is_deleted', '=', 0)
            ->where('jobs.status', '=', 1)
            ->groupBy('job_department.name')  // Group by department name
            ->orderByDesc('total')
            ->limit(50)
            ->get();


        return view('admin.jobs.console', compact('jobs', 'departmentCounts'));
    }
    public function delete_three_month_old_jobs(Request $request)
    {
        DB::table('jobs')->where('jobs.posted', '<=', Carbon::now()->submonths(3))->delete();
        return redirect()->back()->with('message', 'Removed Three month old jobs successfully!');
    }

    public function delete_jobs_with_out_img(Request $request)
    {


        $jobs = DB::table('jobs')
            ->select('jobs.id', 'jobs.img', 'jobs.paper_name')
            ->get();
        // dd($jobs);

        // $jobs_with_out_img = 0;
        if (count($jobs) > 0) {
            // dd($jobs);

            foreach ($jobs as $job) {
                // $imagePath = asset('public/img/') . '/' . $job->paper_name . '/' . $job->img;
                // $imagePath = public_path('img/' . '/' . $job->img);
                $imagePath = storage_path('app/public/jobs/' . $job->img);

                if (!file_exists($imagePath)) {
                    // DB::table('jobs')
                    //     ->where('jobs.id', '=', $job->id)->delete();
                    $update = [
                        'is_deleted' => 1,
                    ];
                    DB::table('jobs')->where('id', $job->id)->update($update);
                }
            }
        }
        DB::table('jobs')->update(['status' => 1]);
        $this->addWatermark();

        DB::table('jobs')
            ->where('posted', '1970-01-01')
            ->update(['posted' => DB::raw('DATE(created_at)')]);

        return redirect()->back()->with('message', 'All With Out Images Job removed successfully!');
        //  $data = YOURMODEL::where('created_at', '<=', Carbon::now()->subDays(2)->toDateTimeString())->get();
    }


    public function addWatermark()
    {
        $watermark = Image::make(public_path('Watermark.png'))->opacity(20);
        $jobs = DB::table('jobs')
            ->select('jobs.id', 'jobs.img', 'jobs.paper_name')
            ->where('is_deleted', 0)
            ->where('is_watermarked', 0)
            ->get();

        // dd($jobs);
        if (count($jobs) > 0) {
            foreach ($jobs as $job) {
                $imagePath = storage_path('app/public/jobs/' . $job->img);
                if (file_exists($imagePath)) {
                    $image = Image::make($imagePath);
                    $image->insert($watermark, 'center');
                    // $savePath = public_path('images/test/' . $job->img);
                    $savePath = storage_path('app/public/jobs/' . $job->img);
                    $image->save($savePath, 100);
                    DB::table('jobs')->where('id', $job->id)->update(['is_watermarked' => 1]);
                }
            }
        }

        // $watermark = Image::make(public_path('Watermark.png'));
        // $imagePath = storage_path('app/public/jobs/629443_1.jpg');
        // $image = Image::make($imagePath);
        // $image->insert($watermark, 'center');
        // $image->save(public_path('images/test/watermarked.jpg'), 50);
        return 'Watermark added and image optimized successfully!';
    }
    
    public function googleIndex($jobslug)
    {
        
       $job = DB::table('jobs')
                ->select('jobs.*')
                ->where('slug', $jobslug) 
                ->first();
        $googleIndex = new GoogleIndexingService(); 
        $jobUrl = route('job-single', $job->slug); 
        // dd($googleIndex);
        $status = $googleIndex->updateUrl($jobUrl);
        return "Google Indexing API Response Code: " . $status;
    }
}
