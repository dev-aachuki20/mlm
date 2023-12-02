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
        'user_id',
        'package_id',
        'r_payment_id',
        'method',
        'currency',
        'user_email',
        'amount',
        'payment_gateway',
        'payment_approval',
        'json_response',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function package(){
        return $this->belongsTo(Package::class, 'package_id','id');
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function receiptImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','payment-reciept');
    }

    public function getReceiptImageUrlAttribute()
    {
        if($this->receiptImage){
            return $this->receiptImage->file_url;
        }
        return "";
    }


}
