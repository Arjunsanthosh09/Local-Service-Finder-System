<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventUnapprovedLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'service_provider') {
            $provider = Auth::user()->serviceProvider;
            
            if (!$provider || !$provider->is_approved) {
                // Logout manually without using Auth::logout()
                $request->session()->flush();
                $request->session()->regenerate();
                
                return redirect()->route('login')
                    ->with('error', 'Cannot login. Your account is pending admin approval.');
            }
        }
        
        return $next($request);
    }
}