<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'is_active'];

    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class);
    }
}