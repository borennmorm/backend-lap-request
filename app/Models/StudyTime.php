<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyTime extends Model
{
    use HasFactory;

    protected $table = 'study_times';

    public function requests()
    {
        return $this->belongsToMany(Request::class, 'request_study_time', 'study_time_id', 'request_id');
    }

}
