<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function index()
    { 
    $relates = Product::inRandomOrder()->take(4)->get();
    return view('cart')->with(
       [ 
        'relates'=> $relates     
    ]);
    }  

    public function store(Request $request){

        Cart::add($request->id, $request->name, 1, $request->price)
        ->associate('App\Product');

        return redirect()->route('cart')->with('success_message', 'You product add to your cart');
    }

    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Your product has been removed');
    }
}
