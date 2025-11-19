<?php

use Illuminate\Support\Facades\DB;

/**
 * AssetHelper
 *
 * @author Muhammad Shahab <shahab@inoviotech.com>
 * @date   09/06/21
 */

/**
 * Used to generate URL of the CSS file for front end
 */

// function products_with_rating()
// {
//         $data = DB::table('reviews')
//         ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
//         ->selectRaw('products.*')
//         ->selectRaw('AVG(reviews.rating) as rating')
//         ->Where('reviews.status', '=', 1)
//         ->groupBy('reviews.id')
//         // ->limit(7)
//         ->get();
//     return $data;
// }
// function single_products_with_rating($id = null)
// {
//         $data = DB::table('reviews')
//         ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
//         ->selectRaw('products.*')
//         ->selectRaw('AVG(reviews.rating) as rating')
//         ->Where('reviews.status', '=', 1)
//         ->Where('products.id', '=', $id)
//         // ->limit(7)
//         ->get();
//     return $data;
// }
// function product_rating($id = null)
// {
//         $data = DB::table('products')
//         ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
//         ->selectRaw('products.*')
//         ->selectRaw('AVG(reviews.rating) as totalrating')
//         ->selectRaw('reviews.comment,reviews.id')
//         ->Where('products.status', '=', 1)
//         ->Where('products.id', '=', $id)
//         ->first();
//         return $data;
// }
// function featch_business_settings()
// {
//     $data = DB::table('business_settings')
//     ->select('value')
//     ->Where('type', '=', 'seller_fee')
//     ->first();
//     return $data;
// }

// function get_product_with_rating($liment = null,$orderBy)
// {
//         $data = DB::table('products')
//         ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
//         ->selectRaw('products.*')
//         ->selectRaw('AVG(reviews.rating) as rating')
//         ->selectRaw(DB::raw('count(reviews.rating) as count'))
//         ->Where('products.status', '=', 1)
//         ->Where('products.r_url', '!=', null)
//         ->limit($liment)
//         ->orderBy('products.id', $orderBy)
//         ->groupBy('products.id')
//         ->get();
//         return $data;
// }

// function get_product_with_rating_two($liment = null,$orderBy)
// {
//         $data = DB::table('products')
//         ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
//         ->selectRaw('products.*')
//         ->selectRaw('AVG(reviews.rating) as rating')
//         ->selectRaw(DB::raw('count(reviews.rating) as count'))
//         ->Where('products.status', '=', 1)
//         ->Where('products.r_url', '=', null)
//         ->limit($liment)
//         ->orderBy('products.id', $orderBy)
//         ->groupBy('products.id')
//         ->get();
//         return $data;
// }

// function get_product_weekly_deal($liment = null,$orderBy)
// {    $data = DB::table('products')
//         ->Where('status', '=', 1)
//         ->Where('weekly_deal', '=', 1)
//         ->limit($liment)
//         ->orderBy('id', $orderBy)
//         // desc , asc
//         ->get();
//         return $data;
// }

// function get_product($liment = null,$orderBy)
// {    $data = DB::table('products')
//         ->Where('status', '=', 1)
//         ->limit($liment)
//         ->orderBy('id', $orderBy)
//         // desc , asc
//         ->get();
//         return $data;
// }

// function featch_data($table, $liment = null)
// {
//     $data = DB::table($table)
//         ->Where('status', '=', 1)
//         ->limit($liment)
//         ->get();
//     return $data;
// }
// function featch_data_where($table, $where1 = null, $where2 = null, $liment = null)
// {
//     $data = DB::table($table)
//     // ->selectRaw('AVG(reviews.rating) as rating')
//     ->selectRaw('reviews.*')
//         ->Where('status', '=', 1)
//         ->Where($where1, '=', $where2)
//         ->limit($liment)
//         ->orderBy('reviews.id','desc')
//         ->get();
//     return $data;
// }

function popular_job_city()
{
    $data = DB::table('jobs')
    ->join('job_city', 'jobs.city', '=', 'job_city.id')
    ->selectRaw('job_city.name, job_city.slug,job_city.id , count(job_city.name) as city_count ')
    ->groupBy('job_city.id')
    ->orderBy('city_count','DESC')
    ->where('jobs.img','!=',null)
    ->take(10)
    ->get();
    return $data;
}

function popular_job_categories()
{
    $data =  DB::table('jobs')
        ->join('job_department', 'jobs.department', '=', 'job_department.id')
        ->selectRaw('job_department.name, job_department.slug,job_department.id , count(job_department.name) as department_count ')
        ->groupBy('job_department.id')
        ->orderBy('department_count','DESC')
        // ->having('department_count', '>', 8)
        ->where('jobs.img','!=',null)
        ->take(10)
        ->get();

    return $data;
}

function popular_job_categories_name($name = null)
{
        $data =   DB::table('jobs')
        ->join('job_department', 'jobs.department', '=', 'job_department.id')
        ->selectRaw('job_department.name,job_department.slug, job_department.id , count(job_department.name) as department_count ')
        ->where('job_department.name', 'LIKE', '%'.$name.'%')
        ->groupBy('job_department.id')
        ->orderBy('department_count','DESC')
        // ->having('department_count', '>', 8)
        ->where('jobs.img','!=',null)
        ->take(10)
        ->get();



    return $data;
}





// function featch_messages($customer_id = null)
// {
//     if($customer_id){
//     $data = DB::table('messages')
//     ->select('customer_id',DB::raw('count(seen) as count'))
//     ->Where('seen', '=', 0)
//     ->Where('customer_id', '=', $customer_id)
//     ->Where('to_user', '=', 1)
//     ->first();
//     return $data;
//   }
// }

// function count_messages($customer_id = null)
// {
//     if($customer_id){
//     $data = DB::table('messages')
//     ->select('customer_id',DB::raw('count(seen) as count'))
//     ->Where('seen', '=', 0)
//     ->Where('customer_id', '=', $customer_id)
//     ->Where('from_user', '=', 1)
//     ->first();
//     return $data;
//   }
// }
