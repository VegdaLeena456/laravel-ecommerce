<?php

namespace App\Http\Controllers;

use App\Models\Product;

class FavoriteController extends Controller
{
    public function store($id)
    {
        $product = Product::findOrFail($id);
        $favorite = session()->get('favorite', []);

        if (isset($favorite[$id])) {
            unset($favorite[$id]);
            session()->put('favorite', $favorite);

            return redirect()->back()->with('success', 'Removed from favorite');
        }

        $favorite[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'type' => $product->type,
            'image' => $product->thumbnail,
        ];

        session()->put('favorite', $favorite);

        return redirect()->back()->with('success', 'Added to favorite');
    }

    public function delete($id)
    {
        $favorite = session()->get('favorite', []);
        if (isset($favorite[$id])) {
            unset($favorite[$id]);
            session()->put('favorite', $favorite);
        }

        return redirect()->back()->with('success', 'Removed from favorite');
    }
}
