<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    
    public function checkout()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);
        $grandTotal = 0;

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        foreach ($cart as $id => $item) {
            $cart[$id]['subtotal'] = $item['price'] * $item['quantity'];
            $grandTotal += $cart[$id]['subtotal'];

        }

        return view('customer.products.checkout', compact('cart', 'grandTotal'));
    }

    public function placeOrder(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone' => 'nullable',
        ]);

        // Get Cart from session

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }
        $grandTotal = 0;

        foreach ($cart as $item) {
            $grandTotal += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'address' => $request->address,
            'email' => $request->email,
            'state' => $request->state,
            'city' => $request->city,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'total_price' => $grandTotal,
            'payment_method' => 'cod',
            'status' => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'price' => $item['price'],
                'quntity' => $item['quantity'],
            ]);
        }

        // load the items before send mail
        $order = $order->load('items');  

        Mail::to('vegdaleena44@gmail.com')->send(new OrderPlaced($order));
        Mail::to($order->email)->send(new OrderPlaced($order));

        session()->forget('cart');

        return redirect()->route('product-list')->with('success', 'Your Order has been Placed ');

    }

    public function orderInfo(){
        $orders = Auth::user()->orders()->with('items')->get();
        return view('customer.profile.profile-info', compact('orders'));
    }
}
