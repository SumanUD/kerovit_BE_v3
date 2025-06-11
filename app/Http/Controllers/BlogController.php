<?php

// BlogController.php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
class BlogController extends Controller
{
    // public function index()
    // {
    //     $blogs = Blog::latest()->get();
    //     return view('admin.blog.index', compact('blogs'));
    // }

    public function index()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpg,jpeg,png',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'gallery.*' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $blog = new Blog();

        if ($request->hasFile('banner_image')) {
            $blog->banner_image = $request->file('banner_image')->store('blogs/banner', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryImages = [];
            foreach ($request->file('gallery') as $img) {
                $galleryImages[] = $img->store('blogs/gallery', 'public');
            }
            $blog->gallery = json_encode($galleryImages);
        }

        $blog->short_description = $request->short_description;
        $blog->long_description = $request->long_description;

        $blog->save();

        return redirect()->route('blog.data')->with('success', 'Blog created successfully.');
    }

        public function getData(Request $request)
    {
        return datatables(Blog::query())->make(true);
    }

    public function showData()
    {
        return view('admin.blog.showdata');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('banner_image')) {
            $blog->banner_image = $request->file('banner_image')->store('blogs/banner', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryImages = [];
            foreach ($request->file('gallery') as $img) {
                $galleryImages[] = $img->store('blogs/gallery', 'public');
            }
            $blog->gallery = json_encode($galleryImages);
        }

        $blog->short_description = $request->short_description;
        $blog->long_description = $request->long_description;

        $blog->save();

        return redirect()->route('blog.data')->with('success', 'Blog updated successfully.');
    }

        public function destroy(Blog $id)
    {
        $id->delete();
        return redirect()->route('blog.data')->with('success', 'Product deleted successfully!');
    }
}