@extends('layouts.app')

@section('title', 'Pending Approval')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="fas fa-clock fa-4x text-warning mb-3"></i>
                    <h3>Application Under Review</h3>
                    <p class="lead">Your service provider application has been submitted successfully.</p>
                    <p>Our admin team will review your application and approve it within 24-48 hours.</p>
                    <hr>
                    <p>You will receive an email notification once your account is approved.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection