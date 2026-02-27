<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    public function productList()
    {
        $products = Product::all();
        return view('customer.products.list', compact('products'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('customer.products.details', compact('product'));
    }

}
