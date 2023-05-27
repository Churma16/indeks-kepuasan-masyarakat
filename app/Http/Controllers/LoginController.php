<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        // Validate the form input fields.
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user using the provided credentials.
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect the user to the intended page or dashboard.
            return redirect()->intended('/dashboard');
        }

        // If authentication fails, redirect back to the login form with an error message.
        return back()->with('loginError', 'Email atau password yang dimasukan salah!');
    }

    /**
     * Logout the authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Logout the authenticated user.
        Auth::logout();

        // Redirect the user to the login page.
        return redirect('/login');
    }
}
