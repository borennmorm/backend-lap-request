<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyTimeApproval extends Model
{
    use HasFactory;

    // Allow mass assignment of these fields
    protected $fillable = ['request_id', 'study_time_id', 'is_approved'];

    // Define relationships

    // A StudyTimeApproval belongs to a LabRequest
    public function labRequest()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }

    // A StudyTimeApproval belongs to a StudyTime
    public function studyTime()
    {
        return $this->belongsTo(StudyTime::class, 'study_time_id');
    }
}
