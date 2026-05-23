<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Add this to the dashboard method to get all providers and bookings
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalProviders = ServiceProvider::count();
        $totalBookings = Booking::count();
        $pendingProviders = ServiceProvider::where('is_approved', false)->count();

        $pendingProviderList = ServiceProvider::where('is_approved', false)
            ->with('user', 'category')
            ->latest()
            ->get();

        $allProviders = ServiceProvider::with('user', 'category')
            ->latest()
            ->paginate(20);

        $allBookings = Booking::with('user', 'serviceProvider', 'category')
            ->latest()
            ->paginate(20);

        $categories = ServiceCategory::all();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProviders',
            'totalBookings',
            'pendingProviders',
            'pendingProviderList',
            'allProviders',
            'allBookings',
            'categories'
        ));
    }

    // Add these new methods
    public function updateProvider(Request $request, ServiceProvider $provider)
    {
        $request->validate([
            'business_name' => 'required|string',
            'phone' => 'required|string',
            'city' => 'required|string',
            'area' => 'required|string',
            'base_price' => 'required|numeric',
            'status' => 'required|in:available,working,free,on_leave',
        ]);

        $provider->update($request->all());

        return back()->with('success', 'Provider updated successfully!');
    }

    public function deleteProvider(ServiceProvider $provider)
    {
        $user = $provider->user;
        $provider->delete();
        $user->delete();

        return back()->with('success', 'Provider deleted successfully!');
    }

    public function updateCategory(Request $request, ServiceCategory $category)
    {
        $request->validate([
            'name' => 'required|string',
            'icon' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'icon' => $request->icon,
            'is_active' => $request->is_active,
        ]);

        return back()->with('success', 'Category updated successfully!');
    }

    public function deleteCategory(ServiceCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted successfully!');
    }

    public function providers()
    {
        $providers = ServiceProvider::with('user', 'category')
            ->latest()
            ->paginate(20);

        return view('admin.providers', compact('providers'));
    }

    public function approveProvider(ServiceProvider $provider)
    {
        $provider->update(['is_approved' => true]);

        return back()->with('success', 'Provider approved successfully!');
    }

    public function rejectProvider(ServiceProvider $provider)
    {
        $user = $provider->user;
        $provider->delete();
        $user->delete();

        return back()->with('success', 'Provider rejected and removed.');
    }

    public function categories()
    {
        $categories = ServiceCategory::all();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:service_categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        ServiceCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon ?? 'fa-tools',
            'is_active' => true,
        ]);

        return back()->with('success', 'Category created successfully!');
    }

    public function bookings()
    {
        $bookings = Booking::with('user', 'serviceProvider', 'category')
            ->latest()
            ->paginate(20);

        return view('admin.bookings', compact('bookings'));
    }

    public function users()
    {
        $users = User::where('role', 'user')
            ->with('bookings')
            ->latest()
            ->paginate(20);

        return view('admin.users', compact('users'));
    }
}