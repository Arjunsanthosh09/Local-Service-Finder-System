<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    // Remove the __construct method completely
    
    public function create(ServiceProvider $provider)
    {
        return view('bookings.create', compact('provider'));
    }

    public function store(Request $request, ServiceProvider $provider)
    {
        $request->validate([
            'service_date' => 'required|date|after:today',
            'service_time' => 'required',
            'address' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $booking = Booking::create([
            'booking_number' => 'BKG-' . strtoupper(Str::random(10)),
            'user_id' => Auth::id(),
            'service_provider_id' => $provider->id,
            'service_category_id' => $provider->service_category_id,
            'service_date' => $request->service_date,
            'service_time' => $request->service_time,
            'address' => $request->address,
            'description' => $request->description,
            'status' => 'pending',
            'expires_at' => now()->addHours(1),
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully!');
    }

    public function show(Booking $booking)
    {
        if (Auth::user()->role == 'user' && $booking->user_id != Auth::id()) {
            abort(403);
        }
        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Cannot cancel this booking now.');
        }

        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking cancelled successfully.');
    }

    public function accept(Booking $booking)
    {
        if ($booking->expires_at < now()) {
            $booking->update(['status' => 'expired']);
            return back()->with('error', 'Booking request has expired.');
        }

        $booking->update([
            'status' => 'accepted',
            'accepted_at' => now()
        ]);

        return redirect()->route('provider.dashboard')
            ->with('success', 'Booking accepted successfully.');
    }

    public function reject(Booking $booking)
    {
        if ($booking->expires_at < now()) {
            $booking->update(['status' => 'expired']);
            return back()->with('error', 'Booking request has expired.');
        }

        $booking->update([
            'status' => 'rejected',
            'rejected_at' => now()
        ]);

        return redirect()->route('provider.dashboard')
            ->with('success', 'Booking rejected.');
    }

    public function complete(Booking $booking)
    {
        $booking->update(['status' => 'completed']);
        
        return redirect()->route('provider.dashboard')
            ->with('success', 'Service marked as completed.');
    }
}