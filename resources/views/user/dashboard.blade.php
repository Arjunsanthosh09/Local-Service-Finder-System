@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-user-circle fa-4x mb-3 text-primary"></i>
                    <h5>{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <hr>
                    <p><strong>Total Bookings:</strong> {{ Auth::user()->bookings->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">My Bookings</h5>
                </div>
                <div class="card-body">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Booking #</th>
                                        <th>Service Provider</th>
                                        <th>Service</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td><strong>{{ $booking->booking_number }}</strong></td>
                                        <td>{{ $booking->serviceProvider->business_name }}</td>
                                        <td>{{ $booking->category->name }}</td>
                                        <td>
                                            {{ date('d M Y', strtotime($booking->service_date)) }}<br>
                                            <small>{{ date('h:i A', strtotime($booking->service_time)) }}</small>
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                                @if($booking->expires_at > now())
                                                    <small class="d-block text-danger">
                                                        Expires in {{ now()->diffInMinutes($booking->expires_at) }} min
                                                    </small>
                                                @endif
                                            @elseif($booking->status == 'accepted')
                                                <span class="badge bg-success">Accepted</span>
                                            @elseif($booking->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @elseif($booking->status == 'cancelled')
                                                <span class="badge bg-secondary">Cancelled</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge bg-info">Completed</span>
                                            @elseif($booking->status == 'expired')
                                                <span class="badge bg-dark">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this booking?')">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $bookings->links() }}
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                            <p>No bookings yet.</p>
                            <a href="{{ route('search') }}" class="btn btn-primary">Book a Service Now</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection