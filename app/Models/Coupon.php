<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = "coupons";
    protected $fillable = ['code', 'type', 'value', 'cart_value', 'expired_at'];
}
