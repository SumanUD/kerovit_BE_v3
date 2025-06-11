<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $collections = Collection::orderBy('order')->get();
        $editCollection = null;

        if ($request->has('edit')) {
            $editCollection = Collection::findOrFail($request->edit);
        }

        return view('admin.collections.crud', compact('collections', 'editCollection'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

    
        if ($request->hasFile('thumbnail_image')) {
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('collections', 'public');
        }
    
        $validated['is_active'] = $request->input('is_active', 0);
    
        Collection::create($validated);
    
        return redirect()->route('collections.index')->with('success', 'Collection created successfully!');
    }
    
    
    

    public function update(Request $request, Collection $collection)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('thumbnail_image')) {
            if ($collection->thumbnail_image) {
                Storage::disk('public')->delete($collection->thumbnail_image);
            }
            $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('collections', 'public');
        }

        $validated['is_active'] = $request->input('is_active', 0);

        $collection->update($validated);

        return redirect()->route('collections.index')->with('success', 'Collection updated successfully!');
    }
}
