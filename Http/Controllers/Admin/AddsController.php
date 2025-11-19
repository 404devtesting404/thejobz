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
class AddsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $adds =  $users = DB::table('adds')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.adds.index', compact('adds'));
    }


    public function images()
    {
        $adds =  $users = DB::table('adds')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.jobs.images', compact('adds'));
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
        $data = DB::table('adds')
            ->where('adds.id', $request->id)
            ->first();
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


}
