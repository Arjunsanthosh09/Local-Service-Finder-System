<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $fillable = [
        'user_id', 'service_category_id', 'business_name', 'phone', 
        'address', 'city', 'area', 'pincode', 'description', 
        'experience', 'documents', 'status', 'is_approved',
        'base_price', 'rating', 'total_reviews'
    ];

    protected $casts = [
        'documents' => 'array',
        'is_approved' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}