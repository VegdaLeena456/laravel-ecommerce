<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'product';
    protected $fillable = [
        'name', 
        'price', 
        'description', 
        'type' ,
        'gallery', 
        'thumbnail' 
        ];

    protected $casts = [
        'gallery' => 'array',
    ];

    function orders(){
        return $this->hasMany(Order::class);
    }
}
