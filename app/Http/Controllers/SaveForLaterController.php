<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;


class SaveForLaterController extends Controller
{
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message', 'Item has been removed');
    }

    public function switchToSaveForLater($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $dublicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId == $id;
        });

        if ($dublicates->isNotEmpty()) {
            return redirect()->route('cart')->with('success_message', 'Item is already Saved For Later!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');

        return redirect()->route('cart')->with('success_message', 'Item has been moved to Cart');
    }
}
