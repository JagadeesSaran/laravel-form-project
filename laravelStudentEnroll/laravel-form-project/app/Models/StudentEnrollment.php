<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
    protected $fillable = [
        'name',
        'mobile_number',
        'email',
        'degree',
        'major',
        'age',
        'mode',
        'professional',
        'experience',
        'time_slot',
        'course'
    ];

    protected $casts = [
        'experience' => 'integer',
        'age' => 'integer',
        'time_slot' => 'array',
    ];
}
