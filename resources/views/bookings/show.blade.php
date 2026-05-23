@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-ticket-alt"></i> Booking Details</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>Booking Number: <strong class="text-primary">{{ $booking->booking_number }}</strong></h5>
                        <span class="badge badge-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'accepted' ? 'success' : 'danger') }} p-2">
                            Status: {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <strong><i class="fas fa-user"></i> Customer Details</strong>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                                    <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                                    <p><strong>Address:</strong> {{ $booking->address }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <strong><i class="fas fa-store"></i> Service Provider Details</strong>
                                </div>
                                <div class="card-body">
                                    <p><strong>Business:</strong> {{ $booking->serviceProvider->business_name }}</p>
                                    <p><strong>Service:</strong> {{ $booking->category->name }}</p>
                                    <p><strong>Phone:</strong> {{ $booking->serviceProvider->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <strong><i class="fas fa-calendar"></i> Service Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Service Date:</strong> {{ date('l, d M Y', strtotime($booking->service_date)) }}</p>
                                    <p><strong>Service Time:</strong> {{ date('h:i A', strtotime($booking->service_time)) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Created:</strong> {{ $booking->created_at->format('d M Y, h:i A') }}</p>
                                    <p><strong>Expires:</strong> {{ $booking->expires_at ? $booking->expires_at->format('d M Y, h:i A') : 'N/A' }}</p>
                                </div>
                            </div>
                            @if($booking->description)
                                <p><strong>Description:</strong> {{ $booking->description }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        @if($booking->status == 'pending')
                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    <i class="fas fa-times"></i> Cancel Booking
                                </button>
                            </form>
                            
                            @if($booking->expires_at && $booking->expires_at > now())
                                <div class="alert alert-warning">
                                    <i class="fas fa-hourglass-half"></i> 
                                    Booking expires in <span id="timer">{{ $booking->expires_at->diffInMinutes(now()) }}</span> minutes
                                </div>
                            @endif
                        @elseif($booking->status == 'accepted')
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Your booking has been accepted!
                            </div>
                        @elseif($booking->status == 'completed')
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                <i class="fas fa-star"></i> Write a Review
                            </a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('reviews.store', $booking) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Rating</label>
                        <select name="rating" class="form-control" required>
                            <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                            <option value="4">⭐⭐⭐⭐ - Good</option>
                            <option value="3">⭐⭐⭐ - Average</option>
                            <option value="2">⭐⭐ - Poor</option>
                            <option value="1">⭐ - Terrible</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Comment</label>
                        <textarea name="comment" class="form-control" rows="3" placeholder="Share your experience..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if($booking->status == 'pending' && $booking->expires_at)
<script>
    function updateTimer() {
        const expiresAt = new Date('{{ $booking->expires_at }}');
        const now = new Date();
        const diff = Math.floor((expiresAt - now) / 60000);
        
        if (diff > 0) {
            document.getElementById('timer').textContent = diff;
            setTimeout(updateTimer, 60000);
        } else {
            location.reload();
        }
    }
    updateTimer();
</script>
@endif
@endpush