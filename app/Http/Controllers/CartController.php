<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $cart = session()->get('cart', []);
        $grandTotal = 0;

        foreach ($cart as $id => $item) {
            // if product delete then remove from cart
            if (! Product::where('id', $id)->exists()) {
                unset($cart[$id]);

                continue;
            }

            $cart[$id]['subtotal'] = $item['price'] * $item['quantity'];
            $grandTotal += $cart[$id]['subtotal'];
        }

        //  update session after removing items
        session()->put('cart', $cart);

        return view('customer.products.cart', compact('cart', 'grandTotal'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'type' => $product->type,
                'image' => $product->thumbnail,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product Added to Cart');

    }

    public function update(Request $request, $id)
    {
        if ($request->input('quantity') <= 0) {
            return back();
        }

        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function delete($id)
    {

        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product Removed from Cart');
    }
}
