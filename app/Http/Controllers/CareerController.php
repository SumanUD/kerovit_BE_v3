<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;

class CareerController extends Controller
{
    public function create()
    {
        $career = Career::first(); // Edit mode for single-row setup
        return view('admin.career.create', compact('career'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'banner_text' => 'required|string',
            'below_banner_description' => 'required|string',
            'center_image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'application_email' => 'required|email',
        ]);

        $career = Career::firstOrNew(['id' => 1]); // Only one row logic

        // Handle banner image
        if ($request->hasFile('banner_image')) {
            $career->banner_image = $request->file('banner_image')->store('career/banner', 'public');
        }

        // Handle center image
        if ($request->hasFile('center_image')) {
            $career->center_image = $request->file('center_image')->store('career/center', 'public');
        }

        // Set text fields
        $career->banner_text = $request->input('banner_text');
        $career->below_banner_description = $request->input('below_banner_description');
        $career->application_email = $request->input('application_email');

        $career->save();

        return redirect()->route('career.create')->with('success', 'Career page content saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'banner_text' => 'required|string',
            'below_banner_description' => 'required|string',
            'center_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'application_email' => 'required|email',
        ]);

        $career = Career::findOrFail($id);

        if ($request->hasFile('banner_image')) {
            $career->banner_image = $request->file('banner_image')->store('career/banner', 'public');
        }

        if ($request->hasFile('center_image')) {
            $career->center_image = $request->file('center_image')->store('career/center', 'public');
        }

        $career->banner_text = $request->input('banner_text');
        $career->below_banner_description = $request->input('below_banner_description');
        $career->application_email = $request->input('application_email');

        $career->save();

        return redirect()->route('career.create')->with('success', 'Career page content updated successfully!');
    }
}
