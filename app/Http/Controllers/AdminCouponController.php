<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
     public function coupons()
    {
        $coupons = Coupon::orderBy('expired_at', 'DESC')->paginate(12);
        return view('admin.coupon.coupon', compact('coupons'));
    }

    public function add()
    {
        return view('admin.coupon.coupon-add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required',
            'cart_value' => 'required',
            'expired_at' => 'required|date',
        ]);

        Coupon::create([
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'cart_value' => $request->cart_value,
            'expired_at' => $request->expired_at,
        ]);

        return redirect()->route('admin.coupons')->with('success', 'Coupon has been added succesfully ');

    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('admin.coupon.coupon-edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required',
            'cart_value' => 'required',
            'expired_at' => 'required|date',
        ]);

        $coupon = Coupon::findOrFail($id);

        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expired_at = $request->expired_at;
        $coupon->save();

        return redirect()->route('admin.coupons')->with('success', 'Coupon has been updated');

    }

    public function delete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->back()->with('delete', 'Coupon deleted');
    }
}
