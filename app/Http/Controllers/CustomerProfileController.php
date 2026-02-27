<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    // Profile Page

    public function index()
    {
        $favorite = session()->get('favorite', []);
        // Product delete remove from session
        foreach ($favorite as $id => $item) {
            if (! Product::find($id)) {
                unset($favorite[$id]);
            }
        }

        // Update session after cleaning
        session()->put('favorite', $favorite);

        $orders = Auth::user()
            ->orders()
            ->with('items')
            ->get();

        return view('customer.profile.profile-info', compact('favorite', 'orders'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('customer.profile.profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'profile_image' => 'image',
            'number' => 'required|string|max:10',
            'address' => 'nullable',
            'country' => 'required',
            'gender' => 'required',
        ]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile/image', 'public');
            $user->profile_image = $imagePath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->gender = $request->gender;
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile Edited Successfully');

    }
}
