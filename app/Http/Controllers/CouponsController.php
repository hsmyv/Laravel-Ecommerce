<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if(!$coupon){
            return redirect()->route('cart')->withErrors("Invalid coupon code. Please try again");
        }
        $subtotal = str_replace(',', '', Cart::subtotal()); // Remove the comma from the subtotal
        session()->put('coupon',[
            'name' => $coupon->code,
            'discount'=> $coupon->discount($subtotal),
        ]);
        return redirect()->route('cart')->with("success_message", "Coupon has been applied!");

    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->route('cart')->with("success_message", "Coupon has been removed");
    }
}
