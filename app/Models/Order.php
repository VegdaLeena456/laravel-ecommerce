<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    
    protected $fillable = [
        'user_id',
        'first_name', 
        'last_name',
        'country', 
        'email', 
        'address',
        'city', 
        'state', 
        'zip', 
        'phone', 
        'total_price', 
        'payment_method', 
        'status'
        ];

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
