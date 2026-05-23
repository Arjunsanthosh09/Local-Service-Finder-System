@extends('layouts.app')

@section('title', 'Book Service')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-plus"></i> Book Service</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="fas fa-store"></i> {{ $provider->business_name }}</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fas fa-tag"></i> <strong>Service:</strong> {{ $provider->category->name }}<br>
                                <i class="fas fa-star text-warning"></i> <strong>Rating:</strong> {{ number_format($provider->rating, 1) }} ({{ $provider->total_reviews }} reviews)
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $provider->city }}, {{ $provider->area }}<br>
                                <i class="fas fa-rupee-sign"></i> <strong>Base Price:</strong> ₹{{ number_format($provider->base_price ?? 0) }}
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('bookings.store', $provider) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="service_date" class="form-label">Service Date *</label>
                            <input type="date" class="form-control @error('service_date') is-invalid @enderror" 
                                   id="service_date" name="service_date" required>
                            @error('service_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="service_time" class="form-label">Preferred Time *</label>
                            <select class="form-control @error('service_time') is-invalid @enderror" 
                                    id="service_time" name="service_time" required>
                                <option value="">Select Time</option>
                                <option value="09:00">09:00 AM - 10:00 AM</option>
                                <option value="10:00">10:00 AM - 11:00 AM</option>
                                <option value="11:00">11:00 AM - 12:00 PM</option>
                                <option value="12:00">12:00 PM - 01:00 PM</option>
                                <option value="14:00">02:00 PM - 03:00 PM</option>
                                <option value="15:00">03:00 PM - 04:00 PM</option>
                                <option value="16:00">04:00 PM - 05:00 PM</option>
                                <option value="17:00">05:00 PM - 06:00 PM</option>
                            </select>
                            @error('service_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Service Address *</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" required 
                                      placeholder="Enter your full address with landmark"></textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Service Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Describe the service you need (optional)"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-clock"></i> 
                            <strong>Important Note:</strong> This booking request will expire in <strong>1 hour</strong> if not accepted by the service provider.
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle"></i> Confirm Booking
                            </button>
                            <a href="{{ route('search') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Search
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Set minimum date to tomorrow
    const dateInput = document.getElementById('service_date');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];
    
    // Disable past dates
    dateInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        if (selectedDate < tomorrow) {
            alert('Please select a future date');
            this.value = '';
        }
    });
</script>
@endpush