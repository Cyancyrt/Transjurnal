<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role
        ]))
        {
            $request->session()->regenerate();

            return match(Auth::user()->role)
            {
                'admin' => redirect('/admin/dashboard'),
                'translator' => redirect('/translator/dashboard'),
                default => redirect('/user/dashboard'),
            };
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}