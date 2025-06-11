<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection; 
use App\Models\Category;   
use App\Models\Dealer;     
use App\Models\Product;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Query data from models
        $totalCollections = Collection::count();  // Gets the total number of collections
        $totalCategories = Category::count();      // Gets the total number of categories
        $totalDealers = Dealer::count();          // Gets the total number of dealers
        $totalProducts = Product::count();        // Gets the total number of products

        // Pass the data to the view
        return view('dashboard', [
            'totalCollections' => $totalCollections,
            'totalCategories' => $totalCategories,
            'totalDealers' => $totalDealers,
            'totalProducts' => $totalProducts
        ]);
    }

}
