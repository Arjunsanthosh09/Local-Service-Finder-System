@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Filters</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Service Type</label>
                            <select name="service" class="form-control">
                                <option value="">All Services</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ request('service') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="{{ request('city') }}" placeholder="Enter city">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Area/Locality</label>
                            <input type="text" name="area" class="form-control" value="{{ request('area') }}" placeholder="Enter area">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Apply Filters
                        </button>
                        <a href="{{ route('search') }}" class="btn btn-secondary w-100 mt-2">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Found <strong>{{ $providers->total() }}</strong> Service Providers</h4>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Sort by
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Rating: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Experience: High to Low</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="row">
                @foreach($providers as $provider)
                <div class="col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $provider->business_name }}</h5>
                                <span class="status-badge status-{{ $provider->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $provider->status)) }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="badge bg-info">{{ $provider->category->name }}</span>
                            </div>
                            <p class="text-muted small">
                                <i class="fas fa-user"></i> {{ $provider->user->name }}<br>
                                <i class="fas fa-map-marker-alt"></i> {{ $provider->city }}, {{ $provider->area }} - {{ $provider->pincode }}<br>
                                <i class="fas fa-phone"></i> {{ $provider->phone }}
                            </p>
                            <p class="card-text small">{{ Str::limit($provider->description, 120) }}</p>
                            <div class="mb-2">
                                <strong>Experience:</strong> {{ $provider->experience ?? 'Not specified' }}<br>
                                <strong>Base Price:</strong> <span class="text-success fw-bold">₹{{ number_format($provider->base_price ?? 0) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-star text-warning"></i> 
                                    <strong>{{ number_format($provider->rating, 1) }}</strong> 
                                    <small>({{ $provider->total_reviews }} reviews)</small>
                                </div>
                                @auth
                                    @if(auth()->user()->role == 'user')
                                    <a href="{{ route('bookings.create', $provider) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-calendar-check"></i> Book Now
                                    </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-sign-in-alt"></i> Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $providers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection