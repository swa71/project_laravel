<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

 if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    // Redirection vers /admin/posts au lieu de /dashboard
    return redirect()->intended('/admin/posts');
}


    return back()->withErrors([
        'email' => 'Email ou mot de passe invalide.',
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

