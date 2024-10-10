<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'is_approve',
    ];

    public function request() {
        return $this->belongsTo(Request::class);
    }
}
