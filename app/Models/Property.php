<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'price', 'type', 'city', 'estate', 'landmark', 'image',
        'has_water', 'has_wifi', 'has_parking', 'has_security',
        'is_quiet', 'near_transport', 'near_shopping', 'has_view'
    ];

    // THIS IS THE BRIDGE FOR LINE 72
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}