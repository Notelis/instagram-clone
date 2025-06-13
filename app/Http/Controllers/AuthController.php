<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/profile');
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/profile');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users|max:255|min:3',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/profile')->with('success', 'Account created successfully!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        // Check if login is email or username
        $loginType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $loginData = [
            $loginType => $credentials['login'],
            'password' => $credentials['password']
        ];

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
            return redirect()->intended('/profile');
        }

        return back()->withErrors([
            'login' => 'Invalid credentials.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
