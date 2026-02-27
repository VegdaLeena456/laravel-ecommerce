<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Admin Authentication

    public function adminLoginPage()
    {
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('master_admin')->attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.products'));
        }

        return back()->withErrors(['email' => 'Invalid Email or Password'])->withInput();
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('master_admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
