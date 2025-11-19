<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function getfile($filename)
    {
        $file = Storage::disk('public')->get($filename);
    }

    public function testing(Request $request)
    {

        $arr = [10, 10, 20, 10, 50];
        $test = '';
        foreach ($arr as $k => $a) {

            $test = 'index ' . $k;
        }
        dd($test);
    }

    public function formsubmit_two(Request $request)
    {

        $body = '';

        $p = $request->all();
        unset($p['_token']);
        $body .= '<h1>' . $p['mailtitle'] . '</h1>';
        unset($p['mailtitle']);
        unset($p['Agreement']);
        foreach ($p as $key => $pp) {
            $body .= '<p><span style="font-size:15px; font-weight: bold;">' . str_replace('_', ' ', $key) . '</span>' . '<br>' . str_replace('*', '', $pp) . '</p>';
        }
        $MailController = new MailController();
        $MailController->sendEmail('mailtitle', $body);
        return  Redirect::back()->withErrors(['msg' => 'Form Submitted']);
    }

    public function contactus(Request $request)
    {
        $body = '';
        $p = $request->all();
        $body .= '<h1>' . $p['mailtitle'] . '</h1>';
        $body .= '<p> <span style="font-size:15px; font-weight: bold;"> Full Name  </span>: ' . $p['first_name'] . '' . $p['last_name'] . '</p>';
        $body .= '<p> <span style="font-size:15px; font-weight: bold;"> Email : </span>' . $p['email'] . '</p>';
        $body .= '<p> <span style="font-size:15px; font-weight: bold;"> Phone : </span>' . $p['phone'] . '</p>';
        $body .= '<p> <span style="font-size:15px; font-weight: bold;"> Have you placed an order with us : </span>' . $p['question'] . '</p>';
        $body .= '<p> <span style="font-size:15px; font-weight: bold;"> How can we help you : </span>' . $p['help'] . '</p>';

        $MailController = new MailController();
        $MailController->sendEmail('mailtitle', $body);
        return  Redirect::back()->withErrors(['msg' => 'Form Submitted']);
    }

    public function index(Request $request)
    {
        $jobs =  $users = DB::table('jobs')
        ->join('job_department', 'jobs.department', '=', 'job_department.id')
        ->join('job_city', 'jobs.city', '=', 'jobs.id')
        ->select('jobs.id','jobs.img','jobs.posted','jobs.title','jobs.paper_name', 'job_department.name as department','job_city.name as city')
        ->take(5)
        ->get();
        return view('home')->with('jobs', $jobs);
    }
}
