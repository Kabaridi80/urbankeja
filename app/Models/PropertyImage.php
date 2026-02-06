<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    // THIS ALLOWS THE IMAGES TO BE SAVED
    protected $fillable = ['property_id', 'image_path'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}