<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Invoice extends Model
{
    use SoftDeletes;

    public $table = 'invoices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'invoice_number',
        'transaction_details',
        'package_json',
        'user_json',
        'purpose',
        'amount',
        'type',
        'entry_type',
        'date_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function booted()
    {
        static::creating(function ($invoice) {
            $invoice->invoice_number = static::generateUniqueInvoiceNumber();
        });
    }

    private static function generateUniqueInvoiceNumber()
    {
        // Generate your unique invoice number logic here
        // generate a random alphanumeric string
        $invoiceNumber = strtoupper(substr(md5(uniqid()), 0, 10));

        while (static::where('invoice_number', $invoiceNumber)->exists()) {
            $invoiceNumber = strtoupper(substr(md5(uniqid()), 0, 10));
        }

        return $invoiceNumber;
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
