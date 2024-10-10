<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'department',
        'faculty',
        'position',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
