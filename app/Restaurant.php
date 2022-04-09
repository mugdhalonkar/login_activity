<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'code',
        'description',
        'phone_number',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function restaurant_image()
    {
        return $this->belongsTo(RestaurantImage::class);
    }
}
