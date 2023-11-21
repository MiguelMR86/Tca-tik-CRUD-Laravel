<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use App\Models\ProductHasX;
use App\Http\Controllers\Controller;

class DatabaseController extends Controller
{
    // GENERAL
    /**
     * Display a listing of all the resources available.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $stores = Store::all();
        $ProductHasX = ProductHasX::all();
        
        // Returns products & stores names instead of ids ( ProductHasX Table )
        foreach ($ProductHasX as $productStore) {
            $product = Product::where('productId', $productStore->productId)->get();
            $store = Store::where('storeId', $productStore->storeId)->get();
            $productStore->productId = $product[0]->name;
            $productStore->storeId = $store[0]->name;
        }
        
        return view('home', compact('products', 'categories', 'stores', 'ProductHasX'));
    }
}
