<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('moduloSeguridad.login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->only('users_email', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/propiedades');
        }
    
        return back()->withErrors([
            'users_email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
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