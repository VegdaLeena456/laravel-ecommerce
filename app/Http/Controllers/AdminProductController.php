<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    // Product List
    public function index()
    {
        $products = Product::all();

        return view('admin.products.product-list', compact('products'));
    }

    // Show the form for creating a new Product.
    public function create()
    {
        return view('admin.products.product-create');
    }

    // Store a new created Product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
            'price' => 'required',
            'description' => 'nullable',
            'gallery' => 'nullable',
            'thumbnail' => 'required|image',
        ]);

        // Upload Thumbnail Image
        $thumbnailPath = $request->file('thumbnail')->store('product/list', 'public');

        $galleryPath = [];

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPath[] = $image->store('product/list', 'public');
            }
        }

        Product::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
            'gallery' => $galleryPath,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product Created Successflly');
    }

    // Show Product Details
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.product-details', compact('product'));
    }

    // Update the Product
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
            'price' => 'required',
            'description' => 'nullable',
            'gallery' => 'nullable',
            'thumbnail' => 'nullable|image',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('product/list', 'public');
            $product->thumbnail = $thumbnailPath;
        }

        if ($request->hasFile('gallery')) {
            $galleryPath = [];
            foreach ($request->file('gallery') as $image) {
                $galleryPath[] = $image->store('product/list', 'public');
            }
            $product->gallery = $galleryPath;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product Updated Successfully');

    }

    // Show the form for edit Product
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.product-edit', compact('product'));
    }

    // Delete the Product
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('delete', 'Product Removed Successfully');
    }
}
