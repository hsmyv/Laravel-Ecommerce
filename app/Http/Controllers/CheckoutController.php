<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Cart;
use Illuminate\Http\Request;
use Stripe\Stripe;

class CheckoutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout')->with([
            'discount' => $this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax'    => $this->getNumbers()->get('newTax'),
            'newTotal'  => $this->getNumbers()->get('newTotal')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug . ',' . $item->qty;
        })->values()->toJson();

        $stripe = new \Stripe\StripeClient(
            'sk_test_51MSgXMFGPKMMRWmDBByyWpWiDpYJmwSCtYw8jm9XBG1dewrOSlFVjuQzEForXKhIWXtGZCi5ZCO6X88UW3653lMY00Q3NQ2zC7'
        );

        try {
            $response = $stripe->charges->create([
                'amount' => (int) $this->getNumbers()->get('newTotal') * 100,
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'order',
                'metadata'     => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson()
                ],
            ]);
            Cart::instance('default')->destroy();
            session()->forget('coupon');
            return redirect()->route('cart')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (\Exception $e) {
            return back()->with('success_message', 'Wrong! Your payment has been denied!');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $subtotal = str_replace(',', '', Cart::subtotal()); // Remove the comma from the subtotal
        $newSubtotal = ($subtotal - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        return collect([
            'tax'      => $tax,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax'    => $newTax,
            'newTotal'  => $newTotal
        ]);
    }
}
