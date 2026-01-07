<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    protected $fillable = [
        'name',
        'start_month',
        'end_month',
        'year',
        'student_capacity',
        'status',
        'progress'
    ];
}
