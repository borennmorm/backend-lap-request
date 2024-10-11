<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'study_time_id',
        'user_id',
        'request_date',
        'major',
        'subject',
        'generation',
        'software_need',
        'number_of_student',
        'additional',
    ];

    public function lab() {
        return $this->belongsTo(Lab::class);
    }

    public function studyTime() {
        return $this->belongsTo(StudyTime::class);
    }

    public function studyTimes()
    {
        return $this->belongsToMany(StudyTime::class, 'request_study_time');
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function approval() {
        return $this->hasOne(Approval::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }
}
