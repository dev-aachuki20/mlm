<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'r_payment_id',
        'method',
        'currency',
        'user_email',
        'amount',
        'json_response',
        'created_at',
        'updated_at',
    ];

}
