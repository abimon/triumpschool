<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    protected $fillable = [
        'student_id',
        'fee_id',
        'amount',
        'payment_method',
        'payment_status',
        'logged_by'
    ];
}
