<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceProviderController extends Controller
{
    public function showRegistrationForm()
    {
        $categories = ServiceCategory::where('is_active', true)->get();
        return view('provider.register', compact('categories'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'business_name' => 'required|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'area' => 'required|string',
            'pincode' => 'required|string|max:10',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'experience' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'service_provider',
            ]);

            $provider = ServiceProvider::create([
                'user_id' => $user->id,
                'service_category_id' => $request->service_category_id,
                'business_name' => $request->business_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'area' => $request->area,
                'pincode' => $request->pincode,
                'description' => $request->description,
                'experience' => $request->experience,
                'base_price' => $request->base_price,
                'is_approved' => false,  // Not approved yet
                'status' => 'available',
            ]);

            DB::commit();


            return redirect()->route('provider.registered')
                ->with('success', 'Registration successful! Your account is pending admin approval. You will be able to login once approved.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Registration failed: ' . $e->getMessage())->withInput();
        }
    }

    public function registered()
    {
        return view('provider.registered');
    }

    public function pending()
    {
        return view('provider.pending');
    }

    public function dashboard()
{
    $provider = Auth::user()->serviceProvider;
    
    if (!$provider || !$provider->is_approved) {
       
        auth()->guard('web')->logout();
        session()->flush();
        
        return redirect()->route('login')
            ->with('error', 'Your account is pending admin approval. You cannot login until approved.');
    }
    
    $pendingBookings = $provider->bookings()
        ->where('status', 'pending')
        ->where('expires_at', '>', now())
        ->with('user')
        ->get();
        
    $acceptedBookings = $provider->bookings()
        ->where('status', 'accepted')
        ->with('user')
        ->get();
        
    $completedBookings = $provider->bookings()
        ->where('status', 'completed')
        ->with('user', 'review')
        ->get();
    
    return view('provider.dashboard', compact('provider', 'pendingBookings', 'acceptedBookings', 'completedBookings'));
}

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:available,working,free,on_leave'
        ]);
        
        $provider = Auth::user()->serviceProvider;
        $provider->update(['status' => $request->status]);
        
        return back()->with('success', 'Status updated successfully!');
    }
}