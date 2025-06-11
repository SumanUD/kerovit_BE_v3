<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    public function create()
    {
        $homePage = HomePage::first();
        // dd($homePage);
        return view('admin.homepage.create', compact('homePage'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'banner_type' => 'required|string',
            'video_url' => 'nullable|url',
            'slider_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'categories_text' => 'required|string',
            'aurum_text' => 'required|string',
            'klassic_text' => 'required|string',
            'world_of_kerovit_text' => 'required|string',
            'world_of_kerovit_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'world_of_kerovit_button_text' => 'required|string',
            'world_of_kerovit_button_url' => 'required|url',
            'catalogue_pdf_1' => 'nullable|file|mimes:pdf',
            'catalogue_pdf_2' => 'nullable|file|mimes:pdf',
            'about_us_text' => 'required|string',
            'about_us_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'about_us_button_text' => 'required|string',
            'about_us_button_url' => 'required|url',
        ]);

        $homePage = HomePage::firstOrNew(['id' => 1]);

        $homePage->video_url = $request->input('video_url');

        if ($request->banner_type == 'slider') {
            if ($request->hasFile('slider_images')) {
                $sliderImages = [];
                foreach ($request->file('slider_images') as $image) {
                    $sliderImages[] = $image->store('homepage/slider', 'public');
                }
                $homePage->slider_images = json_encode($sliderImages);
            }
        }

        if ($request->hasFile('world_of_kerovit_image')) {
            $homePage->world_of_kerovit_image = $request->file('world_of_kerovit_image')->store('homepage/world_of_kerovit', 'public');
        }

        if ($request->hasFile('catalogue_pdf_1')) {
            $homePage->catalogue_pdf_1 = $request->file('catalogue_pdf_1')->store('homepage/catalogues', 'public');
        }
        if ($request->hasFile('catalogue_pdf_2')) {
            $homePage->catalogue_pdf_2 = $request->file('catalogue_pdf_2')->store('homepage/catalogues', 'public');
        }

        $homePage->banner_type = $request->input('banner_type');
        $homePage->categories_text = $request->input('categories_text');
        $homePage->aurum_text = $request->input('aurum_text');
        $homePage->klassic_text = $request->input('klassic_text');
        $homePage->world_of_kerovit_text = $request->input('world_of_kerovit_text');
        $homePage->world_of_kerovit_button_text = $request->input('world_of_kerovit_button_text');
        $homePage->world_of_kerovit_button_url = $request->input('world_of_kerovit_button_url');
        $homePage->about_us_text = $request->input('about_us_text');
        $homePage->about_us_button_text = $request->input('about_us_button_text');
        $homePage->about_us_button_url = $request->input('about_us_button_url');

        $homePage->save();

        return redirect()->route('homepage.create')->with('success', 'HomePage settings updated successfully!');
    }

    public function update(Request $request, $id)
    {

        // dd($request);
        $request->validate([
            'banner_type' => 'required|string',
            'video_url' => 'required|url',
            'slider_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'categories_text' => 'required|string',
            'aurum_text' => 'required|string',
            'klassic_text' => 'required|string',
            'world_of_kerovit_text' => 'required|string',
            'world_of_kerovit_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'world_of_kerovit_button_text' => 'required|string',
            'world_of_kerovit_button_url' => 'required|url',
            'catalogue_pdf_1' => 'nullable|file|mimes:pdf',
            'catalogue_pdf_2' => 'nullable|file|mimes:pdf',
            'about_us_text' => 'required|string',
            'about_us_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'about_us_button_text' => 'required|string',
            'about_us_button_url' => 'required|url',
        ]);


        $homePage = HomePage::findOrFail($id);

        $homePage->video_url = $request->input('video_url');
        $homePage->banner_type = $request->input('banner_type');

        if ($request->banner_type == 'slider') {
            if ($request->hasFile('slider_images')) {
                $sliderImages = [];
                foreach ($request->file('slider_images') as $image) {
                    $sliderImages[] = $image->store('homepage/slider', 'public');
                }
                $homePage->slider_images = json_encode($sliderImages);
            }
        }

        if ($request->hasFile('world_of_kerovit_image')) {
            $homePage->world_of_kerovit_image = $request->file('world_of_kerovit_image')->store('homepage/world_of_kerovit', 'public');
        }

        if ($request->hasFile('catalogue_pdf_1')) {
            $homePage->catalogue_pdf_1 = $request->file('catalogue_pdf_1')->store('homepage/catalogues', 'public');
        }

        if ($request->hasFile('catalogue_pdf_2')) {
            $homePage->catalogue_pdf_2 = $request->file('catalogue_pdf_2')->store('homepage/catalogues', 'public');
        }

        $homePage->categories_text = $request->input('categories_text');
        $homePage->aurum_text = $request->input('aurum_text');
        $homePage->klassic_text = $request->input('klassic_text');
        $homePage->world_of_kerovit_text = $request->input('world_of_kerovit_text');
        $homePage->world_of_kerovit_button_text = $request->input('world_of_kerovit_button_text');
        $homePage->world_of_kerovit_button_url = $request->input('world_of_kerovit_button_url');
        $homePage->about_us_text = $request->input('about_us_text');
        $homePage->about_us_image = $request->input('about_us_image');
        $homePage->about_us_button_text = $request->input('about_us_button_text');
        $homePage->about_us_button_url = $request->input('about_us_button_url');

        $homePage->save();

        return redirect()->route('homepage.create')->with('success', 'Home Page content updated successfully! Wait for 4-5 minutes before you refresh the frontend to see the changes');
    }

}
