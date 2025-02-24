<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register'); // Blade file we'll create
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        // Create the user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user', // or 'admin' if you want
        ]);

        // Log them in
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Registration successful!');
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Another Blade file we'll create
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['username' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
