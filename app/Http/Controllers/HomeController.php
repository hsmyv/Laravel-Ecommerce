<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('featured', false)->take(4)->inRandomOrder()->get();
        return view('Main')->with('products', $products);
    }
}
