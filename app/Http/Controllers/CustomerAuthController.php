<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerAuthController extends Controller
{
    
    // Customer Registration
    public function registrationPage()
    {
        return view('auth.registration');
    }

    public function registration(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'profile_image' => 'image',
            'number' => 'required|max:10',
            'address' => 'nullable',
        ]);

        $imagePath = null;

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile/image', 'public');
        }

        $otp = rand(1000, 9999);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $imagePath,
            'number' => $request->number,
            'address' => $request->address,
            'country' => $request->country,
            'gender' => $request->gender,
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(1),
            'is_verified' => 0,
        ]);

        $request->session()->put('registered_email', $request->email);
        Mail::to($request->email)->send(new SendOtpMail($otp));

        return redirect()->route('verify');

    }

    // Otp Verification
    public function verify()
    {
        $email = session()->get('registered_email');

        return view('auth.mail.otp-verify', compact('email'));
    }

    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);

        $user = Customer::where('email', $request->session()->get('registered_email'))
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>=', Carbon::now())
            ->first();

        if (! $user) {
            return redirect()->back()->withInput()->with(['message' => 'Invalid Otp']);
        }

        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
            'otp_verified_at' => Carbon::now(),
            'is_verified' => 1,
        ]);

        Auth::login($user);

        return redirect()->route('product-list')->with('OTP verified Successful');
    }

    // Resend OTP
    public function resendOtp(Request $request)
    {
        $email = $request->session()->get('registered_email');

        if (! $email) {
            return redirect()->route('login')->with('message', 'Session expired. Please register again.');
        }

        $user = Customer::where('email', $email)->first();

        if (! $user) {
            return redirect()->route('registration')->with('message', 'User not found.');
        }

        $newOtp = rand(1000, 9999);

        $user->otp = $newOtp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        Mail::to($user->email)->send(new SendOtpMail($newOtp));

        return back()->with('success', 'Otp Resent Successfully');

    }

    // Customer Login
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = Customer::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Invalid Email or Password'])->withInput();
        }

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid Email or Password'])->withInput();
        }

        if (! $user->is_verified) {
            return back()->withErrors(['email' => 'Please verify your email first.'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('product-list'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('product-list');
    }
}
