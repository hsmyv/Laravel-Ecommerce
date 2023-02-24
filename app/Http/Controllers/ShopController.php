<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pagination = 9;
        $categories = Category::all();



        if(request()->category){
            $products = Product::with('categories')->whereHas('categories', function ($query){
                $query->where('slug', request()->category);
            });

            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        }else{
            $products = Product::where('featured', false);
            $categoryName= "Featured";
        }
        
        $minPrice = request()->input('min_price');
        $maxPrice = request()->input('max_price');

        // Add price filter clauses based on the selected price range
        if ($minPrice && $maxPrice) {
            $products = $products->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
        } elseif ($minPrice) {
            $products = $products->where('price', '>=', (float)$minPrice);
        }


        if(request()->sort == "low_high"){
            $products = $products->orderBy('price')->simplePaginate($pagination);
        }elseif(request()->sort == "high_low"){
            $products = $products->orderBy('price', 'desc')->simplePaginate($pagination);
        }else{
            $products = $products->simplePaginate($pagination);
        }


        return view('shop')->with(
        ['products' => $products,
        'categories' => $categories,
        'categoryName'=> $categoryName]
    );

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
