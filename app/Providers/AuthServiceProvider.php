<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Authenticated;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();
        
        // Check after user is authenticated
        Event::listen(Authenticated::class, function ($event) {
            $user = $event->user;
            
            if ($user->role === 'service_provider') {
                $provider = $user->serviceProvider;
                
                if (!$provider || !$provider->is_approved) {
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Your account is pending admin approval.');
                }
            }
        });
    }
}