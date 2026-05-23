@extends('layouts.app')

@section('title', 'Provider Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <i class="fas fa-store fa-4x mb-3 text-primary"></i>
                    <h5>{{ $provider->business_name }}</h5>
                    <p class="text-muted">{{ $provider->category->name }}</p>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h6>Rating</h6>
                            <p class="text-warning">{{ number_format($provider->rating, 1) }} ⭐</p>
                        </div>
                        <div class="col-6">
                            <h6>Status</h6>
                            <span class="status-badge status-{{ $provider->status }}">
                                {{ ucfirst(str_replace('_', ' ', $provider->status)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h6>Update Status</h6>
                    <form action="{{ route('provider.status.update') }}" method="POST">
                        @csrf
                        <select name="status" class="form-control mb-2" onchange="this.form.submit()">
                            <option value="available" {{ $provider->status == 'available' ? 'selected' : '' }}>✅ Available</option>
                            <option value="working" {{ $provider->status == 'working' ? 'selected' : '' }}>🔧 Working</option>
                            <option value="free" {{ $provider->status == 'free' ? 'selected' : '' }}>🆓 Free</option>
                            <option value="on_leave" {{ $provider->status == 'on_leave' ? 'selected' : '' }}>🚫 On Leave</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Booking Requests</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#pending">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#accepted">Accepted</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#completed">Completed</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pending">
                            @forelse($pendingBookings as $booking)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Booking #{{ $booking->booking_number }}</h6>
                                            <p>
                                                <i class="fas fa-user"></i> {{ $booking->user->name }}<br>
                                                <i class="fas fa-calendar"></i> {{ date('d M Y', strtotime($booking->service_date)) }} at {{ date('h:i A', strtotime($booking->service_time)) }}<br>
                                                <i class="fas fa-map-marker-alt"></i> {{ $booking->address }}
                                            </p>
                                            @if($booking->description)
                                                <p><strong>Description:</strong> {{ $booking->description }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6 text-end">
                                            @if($booking->expires_at > now())
                                                <p class="text-danger">Expires in {{ now()->diffInMinutes($booking->expires_at) }} minutes</p>
                                                <form action="{{ route('provider.accept', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check"></i> Accept
                                                    </button>
                                                </form>
                                                <form action="{{ route('provider.reject', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-dark">Expired</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-center">No pending bookings</p>
                            @endforelse
                        </div>
                        
                        <div class="tab-pane fade" id="accepted">
                            @forelse($acceptedBookings as $booking)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h6>Booking #{{ $booking->booking_number }}</h6>
                                            <p>
                                                <i class="fas fa-user"></i> {{ $booking->user->name }}<br>
                                                <i class="fas fa-calendar"></i> {{ date('d M Y', strtotime($booking->service_date)) }} at {{ date('h:i A', strtotime($booking->service_time)) }}<br>
                                                <i class="fas fa-map-marker-alt"></i> {{ $booking->address }}
                                            </p>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <form action="{{ route('provider.complete', $booking) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-check-circle"></i> Mark Completed
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-center">No accepted bookings</p>
                            @endforelse
                        </div>
                        
                        <div class="tab-pane fade" id="completed">
                            @forelse($completedBookings as $booking)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6>Booking #{{ $booking->booking_number }}</h6>
                                            <p>
                                                <i class="fas fa-user"></i> {{ $booking->user->name }}<br>
                                                <i class="fas fa-calendar"></i> {{ date('d M Y', strtotime($booking->service_date)) }} at {{ date('h:i A', strtotime($booking->service_time)) }}
                                            </p>
                                            @if($booking->review)
                                                <div class="alert alert-info">
                                                    <strong>Review:</strong> {{ $booking->review->rating }} ⭐ - {{ $booking->review->comment }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-center">No completed bookings</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection