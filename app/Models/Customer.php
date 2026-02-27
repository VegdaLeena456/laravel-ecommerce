<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Customer extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'number',
        'address',
        'country',
        'gender',
        'otp',
        'otp_verified_at',
        'otp_expires_at',
        'is_verified',
    ];

}
