<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Model\Blog;

class SitemapController extends Controller
{
     public function index(Request $request)
    {
        $jobs =  DB::table('jobs')
        ->join('job_department', 'jobs.department', '=', 'job_department.id')
        ->join('job_city', 'jobs.city', '=', 'job_city.id')
        ->select('jobs.id', 'jobs.updated_at','jobs.img', 'jobs.slug', 'jobs.posted', 'jobs.title', 'jobs.paper_name', 'job_department.name as department', 'job_department.slug as department_slug', 'job_city.name as city')
        ->where('jobs.img', '!=', null)
        ->where('jobs.status', '=', 1)
        ->where('jobs.is_deleted', '=', 0)
        ->orderBy('jobs.id', 'DESC')
        // ->take(5)
        ->get();// Adjust as needed (e.g., paginate if many products)


        $citys = DB::table('jobs')
        ->join('job_city', 'jobs.city', '=', 'job_city.id')
        ->selectRaw('job_city.name, job_city.slug,job_city.id, jobs.updated_at, count(job_city.name) as city_count ')
        ->groupBy('job_city.id')
        ->orderBy('city_count','DESC')
        ->where('jobs.img','!=',null)
        // ->take(10)
        ->get();

        $departments =  DB::table('jobs')
        ->join('job_department', 'jobs.department', '=', 'job_department.id')
        ->selectRaw('job_department.name,jobs.updated_at, job_department.slug,job_department.id , count(job_department.name) as department_count ')
        ->groupBy('job_department.id')
        ->orderBy('department_count','DESC')
        // ->having('department_count', '>', 8)
        ->where('jobs.img','!=',null)
        // ->take(10)
        ->get();

       $blogs = DB::table('blogs')
        ->select('slug', 'updated_at', 'title', 'image')
        ->where('status', 1)
        ->where('is_deleted', 0)
        ->orderBy('updated_at', 'desc')
        ->get();


        $armys = popular_job_categories_name('army');
        $teachings = popular_job_categories_name('teaching');
        $newspapers = [
            'jang',
            'thenews',
            'dawn',
            'nawaiwaqt',
            'aaj',
            'dunya',
            'express',
            'kawish',
            'nation',
            'mashriq',
            'khabrain'
        ];
        $sitemap = view('sitemap', ['jobs' => $jobs,'blogs' => $blogs, 'citys' => $citys, 'departments' => $departments, 'armys' => $armys, 'teachings' => $teachings,'newspapers' => $newspapers])->render();

        return response($sitemap)->header('Content-Type', 'application/xml');
    }
}
