<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'price', 
        'type', 
        'city', 
        'estate', 
        'landmark', 
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}