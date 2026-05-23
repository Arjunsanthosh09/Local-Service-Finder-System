<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceProviderMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (Auth::user()->role !== 'service_provider') {
            abort(403, 'Access Denied. Service provider only.');
        }
        
        $provider = Auth::user()->serviceProvider;
        
        // Check if provider is approved
        if (!$provider || !$provider->is_approved) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')
                ->with('error', 'Your account is pending admin approval. Please wait for approval.');
        }
        
        return $next($request);
    }
}