<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::where('is_active', true)->get();
        $featuredProviders = ServiceProvider::where('is_approved', true)
            ->where('status', 'available')
            ->with('user', 'category')
            ->latest()
            ->take(6)
            ->get();
            
        return view('home', compact('categories', 'featuredProviders'));
    }

    public function search(Request $request)
    {
        $query = ServiceProvider::where('is_approved', true)
            ->with('user', 'category');

        if ($request->has('service') && $request->service) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->service . '%');
            });
        }

        if ($request->has('city') && $request->city) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->has('area') && $request->area) {
            $query->where('area', 'like', '%' . $request->area . '%');
        }

        $providers = $query->paginate(12);
        $categories = ServiceCategory::all();
        
        return view('search-results', compact('providers', 'categories'));
    }
}