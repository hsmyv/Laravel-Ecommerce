<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function index()
    {


        $mightAlsoLike = Product::mightAlsoLike()->get();
        return view('cart')->with(
            [
                'relates' => $mightAlsoLike,
                'discount' => $this->getNumbers()->get('discount'),
                'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
                'newTax'    => $this->getNumbers()->get('newTax'),
                'newTotal'  => $this->getNumbers()->get('newTotal')
            ]
        );
    }

    public function store(Request $request)
    {
        $dublicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->id;
        });

        if ($dublicates->isNotEmpty()) {
            return redirect()->route('cart')->with('success_message', 'Item is already in your cart!');
        }

        Cart::add($request->id, $request->name, 1, $request->price)
            ->associate('App\Product');

        return redirect()->route('cart')->with('success_message', 'You product add to your cart');
    }

    public function update(Request $request, $id)
    {
        return $request->all();
    }

    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Your product has been removed');
    }


    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $dublicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId == $id;
        });

        if ($dublicates->isNotEmpty()) {
            return redirect()->route('cart')->with('success_message', 'Item is already Saved For Later!');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');

        return redirect()->route('cart')->with('success_message', 'Item has been Saved For Later');
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
