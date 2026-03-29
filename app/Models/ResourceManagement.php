<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceManagement extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'mime_type',
        'path',
        'size',
        'program_id',
        'uploaded_by',
    ];
    public function program(){
        return $this->belongsTo(Course::class,'program_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'uploaded_by');
    }
}
