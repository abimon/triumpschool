<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=[
        'user_id',
        'intake_id',
        'mode_of_contact',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function intake(){
        return $this->belongsTo(Intake::class,'intake_id','id');
    }

}
