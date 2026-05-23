<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_number', 'user_id', 'service_provider_id', 'service_category_id',
        'service_date', 'service_time', 'description', 'address', 'status',
        'accepted_at', 'rejected_at', 'cancelled_at', 'expires_at',
        'total_amount', 'cancellation_reason'
    ];

    protected $casts = [
        'service_date' => 'date',
        'expires_at' => 'datetime',
        'accepted_at' => 'datetime',
        'rejected_at' => 'datetime',
        'cancelled_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function isExpired()
    {
        return $this->expires_at && now()->gt($this->expires_at);
    }
}