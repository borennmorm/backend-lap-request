<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building',
        'lab_status',
    ];

    public function requests() {
        return $this->hasMany(Request::class);
    }
}
