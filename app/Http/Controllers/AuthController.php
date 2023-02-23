<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.index');
    }

    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name'  => 'required|min:3',
            'email' => 'required|min:3|unique:users,email',
            'password'=> 'required|min:6'
        ]);

        $user= User::create($attributes);
        Auth()->login($user);

        return redirect()->route('index');
    }


    public function login(Request $request)
    {
         $attributes = $request->validate([
            'email' => 'required|min:3|exists:users,email',
            'password' => 'required|min:3'
        ]);



        if(auth()->attempt($attributes)){
            session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in!');
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid Credentials'
        ]);
    }

    public function logout(Request $request)
    {
        Auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index')->with('success', 'You have been logout');
    }
}
