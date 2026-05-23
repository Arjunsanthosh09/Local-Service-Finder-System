<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if service provider is approved
            if ($user->role === 'service_provider') {
                $provider = $user->serviceProvider;
                if (!$provider || !$provider->is_approved) {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Your account is pending admin approval. Please wait for approval.',
                    ])->onlyInput('email');
                }
            }
            
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}