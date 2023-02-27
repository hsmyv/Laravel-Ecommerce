<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\App;
use Illuminate\Cache\RateLimiter;

use Illuminate\Support\Str;


class AuthController extends Controller
{
    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }

    protected function maxAttempts()
    {
        return 3;
    }

    protected function decayMinutes()
    {
        return 1;
    }

    public function index()
    {
        return view('Auth.index');
    }

    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name'  => 'required|min:3',
            'email' => 'required|min:3|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create($attributes);
        Auth()->login($user);

        return redirect()->route('index');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Throttle the login attempts
        $throttleKey = $this->throttleKey($request);
        $maxAttempts = $this->maxAttempts();
        $decayMinutes = $this->decayMinutes();

        $rateLimiter = app(RateLimiter::class);
        if ($rateLimiter->tooManyAttempts($throttleKey, $maxAttempts, $decayMinutes)) {
            $seconds = $rateLimiter->availableIn($throttleKey);
            $message = "Too many login attempts. Please try again in {$seconds} seconds.";
            return back()->with('error', $message);
        }

        if (auth()->attempt($credentials)) {
            $rateLimiter->clear($throttleKey);
            session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in!');
        }

        $rateLimiter->hit($throttleKey);

        $attemptsLeft = $maxAttempts - $rateLimiter->attempts($throttleKey) + 1;
        $message = 'Invalid login credentials. You have ' . $attemptsLeft . ' attempts left.';

        throw ValidationException::withMessages([
            'email' => $message
        ]);
    }




    public function logout(Request $request)
    {
        Auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index')->with('success', 'You have been logout');
    }


    public function show_account($id)
    {
        $user = User::where('id', $id)->first();
        return view('account', ['user' => $user]);
    }

    public function update_account(Request $request, $id)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users', 'email')->ignore($id)],
        ]);
        $user = User::where('id', $id)->first();
        $user->update($attributes);
        return redirect()->back()->with('success', 'Account has been updated successfully.');
    }

    public function reset_password(Request $request, $id)
    {
        $attributes = $request->validate([
            'password' => 'required|min:6',
            'newPassword' => 'required|min:6'
        ]);

        $user = User::where('id', $id)->first();
        if (Hash::check($attributes['password'], $user->password)) {
            $user->update(['password' => $request->newPassword]);
            return redirect()->back()->with('success', 'Password has been changed successfully.');
        } else {
            return redirect()->back()->withErrors(['password' => 'Current password is incorrect.']);
        }
        return back();
    }


    public function updateImage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $user->clearMediaCollection('images'); // clear previous image if exists
            $media = $user->addMediaFromRequest('image')
                ->usingName($user->name)
                ->toMediaCollection('images');
            $imageUrl = $media->getUrl();
        } else {
            $imageUrl = $user->getFirstMediaUrl('images');
        }

        return response()->json(['image_url' => $imageUrl]);
    }
}
