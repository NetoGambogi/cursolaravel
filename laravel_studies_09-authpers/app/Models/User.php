<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    use HasFactory;

    use SoftDeletes;

    protected $hidden = [
        'password',
        'token'
    ];
}
