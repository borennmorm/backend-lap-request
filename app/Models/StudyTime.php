<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyTime extends Model
{
    use HasFactory;

    protected $table = 'study_times';  // Specify table if needed

    public function requests() {
        return $this->hasMany(Request::class);
    }
}
