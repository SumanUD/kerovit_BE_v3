<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalogue;

class CatalogueController extends Controller
{
    public function create()
    {
        $catalogue = Catalogue::first(); // single-entry setup
        return view('admin.catalogue.create', compact('catalogue'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'description' => 'nullable|string',
            'catalogue_image_1' => 'nullable|image|mimes:jpg,jpeg,png',
            'catalogue_image_2' => 'nullable|image|mimes:jpg,jpeg,png',
            'catalogue_pdf_1' => 'nullable|mimes:pdf',
            'catalogue_pdf_2' => 'nullable|mimes:pdf',
        ]);

        $catalogue = Catalogue::firstOrNew(['id' => 1]);

        if ($request->hasFile('banner_image')) {
            $catalogue->banner_image = $request->file('banner_image')->store('catalogue/banner', 'public');
        }

        if ($request->hasFile('catalogue_image_1')) {
            $catalogue->catalogue_image_1 = $request->file('catalogue_image_1')->store('catalogue/images', 'public');
        }

        if ($request->hasFile('catalogue_image_2')) {
            $catalogue->catalogue_image_2 = $request->file('catalogue_image_2')->store('catalogue/images', 'public');
        }

        if ($request->hasFile('catalogue_pdf_1')) {
            $catalogue->catalogue_pdf_1 = $request->file('catalogue_pdf_1')->store('catalogue/pdfs', 'public');
        }

        if ($request->hasFile('catalogue_pdf_2')) {
            $catalogue->catalogue_pdf_2 = $request->file('catalogue_pdf_2')->store('catalogue/pdfs', 'public');
        }

        $catalogue->description = $request->input('description');
        $catalogue->save();

        return redirect()->route('catalogue.create')->with('success', 'Catalogue content saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'description' => 'nullable|string',
            'catalogue_image_1' => 'nullable|image|mimes:jpg,jpeg,png',
            'catalogue_image_2' => 'nullable|image|mimes:jpg,jpeg,png',
            'catalogue_pdf_1' => 'nullable|mimes:pdf',
            'catalogue_pdf_2' => 'nullable|mimes:pdf',
        ]);

        $catalogue = Catalogue::findOrFail($id);

        if ($request->hasFile('banner_image')) {
            $catalogue->banner_image = $request->file('banner_image')->store('catalogue/banner', 'public');
        }

        if ($request->hasFile('catalogue_image_1')) {
            $catalogue->catalogue_image_1 = $request->file('catalogue_image_1')->store('catalogue/images', 'public');
        }

        if ($request->hasFile('catalogue_image_2')) {
            $catalogue->catalogue_image_2 = $request->file('catalogue_image_2')->store('catalogue/images', 'public');
        }

        if ($request->hasFile('catalogue_pdf_1')) {
            $catalogue->catalogue_pdf_1 = $request->file('catalogue_pdf_1')->store('catalogue/pdfs', 'public');
        }

        if ($request->hasFile('catalogue_pdf_2')) {
            $catalogue->catalogue_pdf_2 = $request->file('catalogue_pdf_2')->store('catalogue/pdfs', 'public');
        }

        $catalogue->description = $request->input('description');
        $catalogue->save();

        return redirect()->route('catalogue.create')->with('success', 'Catalogue content updated successfully!');
    }
}

