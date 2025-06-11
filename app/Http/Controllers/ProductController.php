<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Range;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display the product creation form
    public function create()
    {
        $collections = Collection::all(); // Get all collections
        return view('admin.products.create', compact('collections'));
    }


        // Store the new product
    public function store(Request $request)
    {
        // Validation for all the necessary fields
        $request->validate([
            'collection' => 'required|exists:collections,id',
            'category_name' => 'required|exists:categories,id',
            'ranges' => 'required|exists:ranges,id',
            'product_code' => 'required|unique:products',
            'product_title' => 'required',
            'price' => 'required|numeric',
            'size' => 'required',
            'product_description' => 'required',
            'diagram_image_name' => 'required',
            'installation_service_parts' => 'required',
            'feature_image' => 'required',
            'additional_information' => 'nullable',
            // For additional images
            'additional_image1' => 'nullable|image',
            'additional_image2' => 'nullable|image',
            'additional_image3' => 'nullable|image',
            'additional_image4' => 'nullable|image',
            'additional_image5' => 'nullable|image',
        ]);

        // Get all the input data that needs to be saved
        $productData = $request->only([
            'product_code',
            'product_title',
            'Series',  // Store Series (range)
            'shape',
            'spray',
            'ranges',  // Store range ID
            'collection', // Store collection ID
            'product_description',
            'size',
            'price',
            'installation_service_parts',
            'additional_information',
            'category_name', // Store category ID
        ]);

        // Handle the file uploads
        if ($request->hasFile('thumbnail_picture')) {
            $productData['thumbnail_picture'] = $request->file('thumbnail_picture')->store('AllImages', 'public');
        }
        // Handle the file uploads
        if ($request->hasFile('feature_image')) {
            $productData['feature_image'] = $request->file('feature_image')->store('AllImages', 'public');
        }
        // Handle the file uploads
        if ($request->hasFile('diagram_image_name')) {
            $productData['diagram_image_name'] = $request->file('diagram_image_name')->store('AllImages', 'public');
        }

        if ($request->hasFile('product_image')) {
            $productData['product_image'] = $request->file('product_image')->store('AllImages', 'public');
        }

        // Handle additional images
        if ($request->hasFile('additional_image1')) {
            $productData['additional_image1'] = $request->file('additional_image1')->store('AllImages', 'public');
        }
        
        if ($request->hasFile('additional_image2')) {
            $productData['additional_image2'] = $request->file('additional_image2')->store('AllImages', 'public');
        }

        if ($request->hasFile('additional_image3')) {
            $productData['additional_image3'] = $request->file('additional_image3')->store('AllImages', 'public');
        }

        if ($request->hasFile('additional_image4')) {
            $productData['additional_image4'] = $request->file('additional_image4')->store('AllImages', 'public');
        }

        if ($request->hasFile('additional_image5')) {
            $productData['additional_image5'] = $request->file('additional_image5')->store('AllImages', 'public');
        }

        // Create the new product record
        Product::create($productData);

        // Redirect with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }


        
    public function update(Request $request, $product_id)
    {
        // Validation for all the necessary fields
        $request->validate([
            'collection' => 'required|exists:collections,id',
            'category_name' => 'required|exists:categories,id',
            'ranges' => 'required|exists:ranges,id',
            'product_code' => 'required|unique:products,product_code,'  . $product_id . ',product_id',  // Ensure uniqueness except for the current product
            'product_title' => 'required',
            'price' => 'nullable|numeric',
            'size' => 'nullable',
            'product_description' => 'nullable',
            'diagram_image_name' => 'nullable',
            'installation_service_parts' => 'nullable',
            'feature_image' => 'nullable',
            'additional_information' => 'nullable',
            // For additional images
            'additional_image1' => 'nullable|image',
            'additional_image2' => 'nullable|image',
            'additional_image3' => 'nullable|image',
            'additional_image4' => 'nullable|image',
            'additional_image5' => 'nullable|image',
        ]);

        // Find the product by its custom ID field 'product_id'
        $product = Product::where('product_id', $product_id)->firstOrFail();

        // Get the updated input data
        $productData = $request->only([
            'product_code',
            'product_title',
            'Series',  // Store Series (range)
            'shape',
            'spray',
            'ranges',  // Store range ID
            'collection', // Store collection ID
            'product_description',
            'size',
            'price',
            'installation_service_parts',
            'additional_information',
            'category_name', // Store category ID
        ]);

        // Handle the file uploads (if there is any file change)
        if ($request->hasFile('thumbnail_picture')) {
            $productData['thumbnail_picture'] = $request->file('thumbnail_picture')->store('AllImages', 'public');
        }

        if ($request->hasFile('feature_image')) {
            $productData['feature_image'] = $request->file('feature_image')->store('AllImages', 'public');
        }

        if ($request->hasFile('diagram_image_name')) {
            $productData['diagram_image_name'] = $request->file('diagram_image_name')->store('AllImages', 'public');
        }

        if ($request->hasFile('product_image')) {
            $productData['product_image'] = $request->file('product_image')->store('AllImages', 'public');
        }

        // Handle additional images
        if ($request->hasFile('additional_image1')) {
            $productData['additional_image1'] = $request->file('additional_image1')->store('AllImages', 'public');
        }

        if ($request->hasFile('additional_image2')) {
            $productData['additional_image2'] = $request->file('additional_image2')->store('AllImages', 'public');
        }

        if ($request->hasFile('additional_image3')) {
            $productData['additional_image3'] = $request->file('additional_image3')->store('AllImages', 'public');
        }

        if ($request->hasFile('additional_image4')) {
            $productData['additional_image4'] = $request->file('additional_image4')->store('AllImages', 'public');
        }

        if ($request->hasFile('additional_image5')) {
            $productData['additional_image5'] = $request->file('additional_image5')->store('AllImages', 'public');
        }

        // Update the product record with new data
        $product->update($productData);

        // Redirect with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }




    // Update the product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $collections = Collection::all();
        $categories = Category::all();
        $ranges = Range::all();
    
        return view('admin.products.edit', compact('product', 'collections', 'categories', 'ranges'));
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function getCategories($collection)
    {
        // dd($collection);
        $categories = Category::where("collection_id",$collection)->orderBy('order')->get();    
        return response()->json([
            'categories' => $categories->map(fn($category) => [
                'id' => $category->id,
                'name' => $category->name,
                'order' => $category->order,
            ])
        ]);
    }

    public function getRanges($categoryId)
    {
        $category = Category::find($categoryId);
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        $ranges = $category->ranges()->orderBy('order')->get();
    
        return response()->json([
            'ranges' => $ranges->map(fn($range) => [
                'id' => $range->id,
                'name' => $range->name,
                'order' => $range->order,
            ])
        ]);
    }


    public function getData(Request $request)
{
    return datatables(Product::query())->make(true);
}


public function showData()
{
    return view('admin.products.index');
}


public function getAllProductsJson()
{
    $products = Product::with(['collection', 'category', 'range'])->get();

    return response()->json([
        'status' => 'success',
        'products' => $products->map(function ($product) {
            return [
                'id' => $product->id,
                'product_code' => $product->product_code,
                'product_title' => $product->product_title,
                'shape' => $product->shape,
                'spray' => $product->spray,
                'size' => $product->size,
                'price' => $product->price,
                'product_description' => $product->product_description,
                'additional_information' => $product->additional_information,
                'installation_service_parts' => $product->installation_service_parts,

                // Related names
                'collection' => $product->collection,
                'category' => $product->category_name,
                'range' => $product->ranges,

                // Image URLs
                'thumbnail_picture_url' => $product->thumbnail_picture ? asset('storage/' . $product->thumbnail_picture) : null,
                'feature_image_url' => $product->feature_image ? asset('storage/' . $product->feature_image) : null,
                'diagram_image_url' => $product->diagram_image_name ? asset('storage/' . $product->diagram_image_name) : null,
                'product_image_url' => $product->product_image ? asset('storage/' . $product->product_image) : null,

                // Additional images
                'additional_images' => collect([
                    $product->additional_image1,
                    $product->additional_image2,
                    $product->additional_image3,
                    $product->additional_image4,
                    $product->additional_image5,
                ])->filter()->map(fn($img) => asset('storage/' . $img))->values(),
            ];
        }),
    ]);
}


}
