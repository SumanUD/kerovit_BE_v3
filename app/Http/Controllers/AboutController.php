<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
        public function create()
    {
        $about = AboutUs::first();
        // dd($about);
        return view('admin.about.create', compact('about'));
    }
public function store(Request $request)
{
    $request->validate([
        'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        'banner_description' => 'required|string',
        'below_banner_content' => 'required|string',
        'director_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'director_description' => 'required|string',
        'manufacturing' => 'nullable|array',
        'manufacturing.*.name' => 'nullable|string',
        'manufacturing.*.description' => 'nullable|string',
        'manufacturing.*.image' => 'nullable|image|mimes:jpg,jpeg,png',
        'certification_images.*' => 'nullable|image|mimes:jpg,jpeg,png',
    ]);

    $about = AboutUs::firstOrNew(['id' => 1]);

    if ($request->hasFile('banner_image')) {
        $about->banner_image = $request->file('banner_image')->store('about/banner', 'public');
    }

    if ($request->hasFile('director_image')) {
        $about->director_image = $request->file('director_image')->store('about/director', 'public');
    }

    if ($request->hasFile('certification_images')) {
        $certificationImages = [];
        foreach ($request->file('certification_images') as $image) {
            $certificationImages[] = $image->store('about/certifications', 'public');
        }
        $about->certification_images = $certificationImages;
    }

    $manufacturingData = [];
    if ($request->has('manufacturing')) {
        foreach ($request->manufacturing as $index => $item) {
            $imagePath = null;
            if (isset($item['image']) && $item['image']) {
                $imagePath = $item['image']->store('about/manufacturing', 'public');
            }
            $manufacturingData[] = [
                'image' => $imagePath,
                'name' => $item['name'] ?? '',
                'description' => $item['description'] ?? '',
            ];
        }
    }

    $about->banner_description = $request->banner_description;
    $about->below_banner_content = $request->below_banner_content;
    $about->director_description = $request->director_description;
    $about->manufacturing = $manufacturingData;

    $about->save();

    return redirect()->route('about.create')->with('success', 'About settings updated successfully!');
}




public function update(Request $request, $id)
{
    $request->validate([
        'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        'banner_description' => 'required|string',
        'below_banner_content' => 'required|string',
        'director_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'director_description' => 'required|string',
        'manufacturing' => 'nullable|array',
        'manufacturing.*.name' => 'nullable|string',
        'manufacturing.*.description' => 'nullable|string',
        'manufacturing.*.image' => 'nullable|image|mimes:jpg,jpeg,png',
        'certification_images.*' => 'nullable|image|mimes:jpg,jpeg,png',
    ]);

    $about = AboutUs::findOrFail($id);

    // Banner Image
    if ($request->hasFile('banner_image')) {
        if ($about->banner_image) {
            Storage::disk('public')->delete($about->banner_image);
        }
        $about->banner_image = $request->file('banner_image')->store('about/banner', 'public');
    }

    // Director Image
    if ($request->hasFile('director_image')) {
        if ($about->director_image) {
            Storage::disk('public')->delete($about->director_image);
        }
        $about->director_image = $request->file('director_image')->store('about/director', 'public');
    }

    // Certification Images
    if ($request->hasFile('certification_images')) {
        if (is_array($about->certification_images)) {
            foreach ($about->certification_images as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        $certificationImages = [];
        foreach ($request->file('certification_images') as $image) {
            $certificationImages[] = $image->store('about/certifications', 'public');
        }
        $about->certification_images = $certificationImages;
    }

    // Manufacturing Items
    $manufacturingItems = [];
    $inputItems = $request->input('manufacturing', []);

    foreach ($inputItems as $index => $item) {
        $imagePath = $about->manufacturing[$index]['image'] ?? null;

        if ($request->hasFile("manufacturing.$index.image")) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file("manufacturing.$index.image")->store('about/manufacturing', 'public');
        }

        $manufacturingItems[] = [
            'image' => $imagePath,
            'name' => $item['name'] ?? '',
            'description' => $item['description'] ?? '',
        ];
    }

    $about->manufacturing = $manufacturingItems;

    // Other Fields
    $about->banner_description = $request->input('banner_description');
    $about->below_banner_content = $request->input('below_banner_content');
    $about->director_description = $request->input('director_description');

    $about->save();

    return redirect()->route('about.create')->with('success', 'About page content updated successfully!');
}



}
