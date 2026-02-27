<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterAdmin extends Authenticatable
{
    protected $table = 'master_admin';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
