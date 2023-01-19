<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->take(6)->get();

        return view('shop')->with('products', $products);

    }

    public function show($slug){

        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug','!=', $slug)->mightAlsoLike()->get();
        return view('product')->with(
           [
            'product'      => $product,
            'relates'      => $mightAlsoLike
        ]);
    }
}
