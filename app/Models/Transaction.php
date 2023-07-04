<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'payment_id',
        'payment_type',
        'type',
        'amount',
        'gateway',
        'referrer_id',
        'created_at',
        'updated_at',
    ];

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function referralUser(){
        return $this->belongsTo(User::class, 'referrer_id','id');
    }


}
