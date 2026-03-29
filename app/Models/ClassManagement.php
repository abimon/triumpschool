<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassManagement extends Model
{
    protected $fillable = [
        'title',
        'program_id',
        'description',
        'date_time',
        'address',
        'status',
        'created_by',
    ];
    public function program()
    {
        return $this->belongsTo(Course::class, 'program_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    //
}
