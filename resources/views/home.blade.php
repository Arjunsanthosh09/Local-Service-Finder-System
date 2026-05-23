@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <h1 class="display-4">Find Trusted Service Professionals</h1>
                <p class="lead">Connect with electricians, plumbers, and more in your area</p>
                
                <div class="search-box mt-4">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <input type="text" name="service" class="form-control" placeholder="What service do you need? (e.g., Electrician)">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="city" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Popular Services</h2>
    <div class="row">
        @php
            $icons = ['fa-bolt', 'fa-wrench', 'fa-hammer', 'fa-paint-brush', 'fa-snowflake', 'fa-car', 'fa-broom', 'fa-leaf'];
        @endphp
        @foreach($categories as $index => $category)
        <div class="col-md-3 mb-3">
            <div class="card service-card text-center h-100">
                <div class="card-body">
                    <i class="fas {{ $icons[$index % count($icons)] }} fa-3x mb-3 text-primary"></i>
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="text-muted small">{{ $category->description ?? '' }}</p>
                    <a href="{{ route('search', ['service' => $category->name]) }}" class="btn btn-outline-primary btn-sm">
                        Find {{ $category->name }}s
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if(isset($featuredProviders) && $featuredProviders->count() > 0)
    <h2 class="text-center mb-4 mt-5">⭐ Featured Service Providers</h2>
    <div class="row">
        @foreach($featuredProviders as $provider)
        <div class="col-md-4 mb-4">
            <div class="card service-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title">{{ $provider->business_name }}</h5>
                        <span class="status-badge status-{{ $provider->status }}">
                            {{ ucfirst(str_replace('_', ' ', $provider->status)) }}
                        </span>
                    </div>
                    <p class="text-muted mt-2">
                        <i class="fas fa-user"></i> {{ $provider->user->name }}<br>
                        <i class="fas fa-tag"></i> {{ $provider->category->name }}<br>
                        <i class="fas fa-map-marker-alt"></i> {{ $provider->city }}, {{ $provider->area }}
                    </p>
                    <p class="card-text">{{ Str::limit($provider->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-star text-warning"></i> 
                            {{ number_format($provider->rating, 1) }} ({{ $provider->total_reviews }} reviews)
                        </div>
                        @auth
                            @if(auth()->user()->role == 'user')
                            <a href="{{ route('bookings.create', $provider) }}" class="btn btn-primary btn-sm">
                                Book Now
                            </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login to Book</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection