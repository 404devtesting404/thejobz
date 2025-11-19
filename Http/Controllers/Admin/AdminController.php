<?php

namespace App\Http\Controllers\Admin;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use File;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Response;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminHome(Request $request)
    {

        $total_jobs = DB::table('jobs')
            ->select('jobs.id', 'jobs.img')
            ->where('jobs.img', '!=', null)
            ->where('jobs.status', '=', 1)
            ->where('jobs.is_deleted', '=', 0)
            ->count();
        $army_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%army%')
            ->where('jobs.img', '!=', null)
            ->count();

        $navy_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%navy%')
            ->where('jobs.img', '!=', null)
            ->count();

        $police_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%police%')
            ->where('jobs.img', '!=', null)
            ->count();

        $bank_jobs_count = DB::table('job_department')
            ->select('jobs.id', 'jobs.img')
            ->join('jobs', 'job_department.id', '=', 'jobs.department')
            ->where('job_department.name', 'LIKE', '%bank%')
            ->where('jobs.img', '!=', null)
            ->count();

        $popular_job_department =  $users = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->selectRaw('job_department.name, job_department.id , count(job_department.name) as department_count ')
            ->groupBy('job_department.id')
            ->orderBy('department_count', 'DESC')
            // ->having('department_count', '>', 8)
            ->where('jobs.img', '!=', null)
            // ->take(4)
            ->get();
        // dd($popular_job_department);

        if ($request->ajax()) {

            $popular_job_department = DB::table('jobs')
                ->join('job_department', 'jobs.department', '=', 'job_department.id')
                ->selectRaw('job_department.name, job_department.id , count(job_department.name) as department_count ')
                ->groupBy('job_department.id')
                ->orderBy('department_count', 'DESC')
                // ->having('department_count', '>', 8)
                ->where('jobs.img', '!=', null)
                // ->take(4)
                ->get();
            return Datatables::of($popular_job_department)
                ->make(true);
        }

        $content_update_by = DB::table('jobs')
            ->join('users', 'jobs.content_update_by', '=', 'users.id')
            ->selectRaw('DATE(content_update_date) AS update_date, content_update_by, COUNT(*) AS total_updates,users.name,users.fullname')
            ->whereNotNull('content_update_by')
            ->groupBy(DB::raw('DATE(jobs.updated_at)'), 'jobs.content_update_by', 'users.name')
            ->get();


        return view('admin.admin-home')->with('total_jobs', $total_jobs)
            ->with('army_jobs_count', $army_jobs_count)->with('navy_jobs_count', $navy_jobs_count)
            ->with('police_jobs_count', $police_jobs_count)->with('bank_jobs_count', $bank_jobs_count)
            ->with('content_update_by',$content_update_by);
    }

    public function popular_job_city(Request $request)
    {
        if ($request->ajax()) {
            $popular_job_city = DB::table('jobs')
            ->join('job_city', 'jobs.city', '=', 'job_city.id')
            ->selectRaw('job_city.name, job_city.id , count(job_city.name) as city_count ')
            ->groupBy('job_city.id')
            ->orderBy('city_count','DESC')
            // ->having('city_count', '>', 2)
            ->where('jobs.img','!=',null)
            // ->take(6)
            ->get();
            return Datatables::of($popular_job_city)
            ->make(true);
        }
    }
public function popular_job(Request $request)
    {
        if ($request->ajax()) {

            $popular_job = DB::table('jobs')
            ->join('job_department', 'jobs.department', '=', 'job_department.id')
            ->join('job_city', 'job_city.id', '=', 'jobs.city')
            ->select(
                'jobs.id',
                'jobs.slug', // Add this line
                'jobs.view',
                'jobs.title',
                'jobs.posted',
                'jobs.paper_name',
                'job_department.name as department'
            )
            ->whereNotNull('jobs.img')
            ->where('jobs.view', '>', 0)
            ->orderByRaw('CAST(jobs.view AS UNSIGNED) DESC')
            ->get();

            return Datatables::of($popular_job)
                ->addColumn('action', function($row){
                    $url = url('/job-single/' . $row->slug);
                    return '<a href="'.$url.'" target="_blank" class="btn btn-sm btn-primary">View</a>';
                })
            ->rawColumns(['action']) // Allow HTML rendering
            ->make(true);

            
            // $popular_job = DB::table('jobs')
            //     ->join('job_department', 'jobs.department', '=', 'job_department.id')
            //     ->join('job_city', 'job_city.id', '=', 'jobs.city')
            //     ->select(
            //         'jobs.view',
            //         'jobs.title',
            //         'jobs.posted',
            //         'jobs.paper_name',
            //         'job_department.name as department'
            //     )
            //     ->whereNotNull('jobs.img')
            //     ->where('jobs.view', '>', 0)
            //     ->orderByRaw('CAST(jobs.view AS UNSIGNED) DESC') // Type-casting to ensure numeric sorting
            //     ->get();


            // return Datatables::of($popular_job)
            //     ->make(true);
        }
    }
}
