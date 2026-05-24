<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);
        
        if ($booking->status != 'completed' || $booking->user_id != Auth::id()) {
            return back()->with('error', 'You cannot review this booking.');
        }
        
        if ($booking->review) {
            return back()->with('error', 'You have already reviewed this booking.');
        }
        
        $review = Review::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'service_provider_id' => $booking->service_provider_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);
        
        // Update provider rating
        $provider = $booking->serviceProvider;
        $averageRating = $provider->reviews()->avg('rating');
        $provider->update([
            'rating' => round($averageRating, 2),
            'total_reviews' => $provider->reviews()->count()
        ]);
        
        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Thank you for your review!');
    }
}