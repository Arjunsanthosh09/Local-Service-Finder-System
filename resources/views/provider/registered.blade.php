@extends('layouts.app')

@section('title', 'Registration Submitted')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
                    <h2>Registration Submitted Successfully!</h2>
                    <p class="lead mt-3">Thank you for registering as a service provider.</p>
                    
                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle"></i>
                        <strong>What happens next?</strong>
                        <ul class="text-start mt-3">
                            <li>✓ Your application has been submitted</li>
                            <li>✓ Admin will review your application</li>
                            <li>✓ You will receive an email notification when approved</li>
                            <li>✓ Once approved, you can login and start accepting bookings</li>
                            <li>⏱ This process usually takes 24-48 hours</li>
                        </ul>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> Return to Home
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-sign-in-alt"></i> Go to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection