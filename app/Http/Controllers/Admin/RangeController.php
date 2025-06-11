<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Range;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RangeController extends Controller
{
    public function index(Request $request)
    {
        $ranges = Range::with('category')->orderBy('order')->get();
        $collections = Collection::active()->get();

        $editRange = null;
        $selectedCollection = null;
        $categoriesForCollection = [];

        if ($request->has('edit')) {
            $editRange = Range::findOrFail($request->edit);
            $selectedCollection = $editRange->category->collection_id ?? null;
            $categoriesForCollection = Category::where('collection_id', $selectedCollection)->active()->get();
        }

        return view('admin.ranges.crud', compact('ranges', 'collections', 'editRange', 'categoriesForCollection', 'selectedCollection'));
    }

    public function getCategoriesByCollection(Request $request)
    {
        $collectionId = $request->get('collection_id');
        $categories = $collectionId
            ? Category::where('collection_id', $collectionId)->active()->get()
            : [];

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'collection_id' => 'required|exists:collections,id',
            'name' => 'required|string|max:255',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer'
        ]);

        $data = $request->except('thumbnail_image');
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('thumbnail_image')) {
            $data['thumbnail_image'] = $request->file('thumbnail_image')->store('ranges', 'public');
        }

        Range::create($data);

        return redirect()->route('admin.ranges.index')->with('success', 'Range created successfully.');
    }

    public function update(Request $request, Range $range)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer'
        ]);

        $data = $request->except('thumbnail_image');
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('thumbnail_image')) {
            $data['thumbnail_image'] = $request->file('thumbnail_image')->store('ranges', 'public');
        }

        $range->update($data);

        return redirect()->route('admin.ranges.index')->with('success', 'Range updated successfully.');
    }

}
