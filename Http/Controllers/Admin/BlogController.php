<?php

namespace App\Http\Controllers\Admin;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use File;
use Carbon\Carbon;
// use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function index(Request $request)
    {
        $blog = DB::table('blogs')->paginate(10);
        return view('admin.blogs.index', compact('blog'));
    }
    public function create(Request $request)
    {
        $blog = DB::table('blogs')->paginate(10);
        return view('admin.blogs.create', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_keywords' => 'required|string',
            'meta_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $blog = new Blog();
        $blog->title = $request->title;
        $blog->topic = $request->topic;
        $blog->meta_keywords = $request->tmeta_keywordsitle;
        $blog->slug = \Str::slug($request->title);
        $blog->meta_description = $request->meta_description;
        $blog->description = $request->description;

        $blog->created_at = now();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image = $imagePath;
        }

        $blog->save();
        return redirect('/admin/blog/index')->with('message', 'Blog added successfully!');

        return redirect()->back()->with('message', 'Blog add successfully!');
    }
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        // Delete associated image if exists
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();
        return redirect()->back()->with('success', 'Blog deleted successfully!');
    }
    public function toggleStatus($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = !$blog->status;
        $blog->save();
        return redirect()->back()->with('success', 'Blog Status Update successfully!');
    }
    public function edit(Request $request)
    {
        $blog = Blog::findOrFail($request->id); // find blog by ID
        return view('admin.blogs.edit', compact('blog'));
    }
    public function update(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->title = $request->input('title');
        $blog->topic = $request->input('topic');
        $blog->description = $request->input('description');
        $blog->meta_keywords = $request->input('meta_keywords');
        $blog->meta_description = $request->input('meta_description');

    //   if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         // Get original extension (e.g., jpg, png)
    //         $extension = $image->getClientOriginalExtension();
    //         // Generate random file name
    //         $filename = Str::random(20) . '.' . $extension;
    //         // Store in storage/app/public/blog_images/
    //         $image->storeAs('blog_images', $filename, 'public');
    //         // Save just the random filename in DB
    //         $blog->image = $filename;
    //     }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $blog->image = $imagePath;
        }
        $blog->save();
        return redirect('/admin/blog/index')->with('message', 'Blog updated successfully!');
        return back();
    }
}
