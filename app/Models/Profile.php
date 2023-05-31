<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $guard = 'web';

    public $table = 'profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'guardian_name',
        'gender',
        'profession',
        'marital_status',
        'address',
        'state',
        'city',
        'pin_code',
        'nominee_name',
        'nominee_dob',
        'nominee_relation',
        'bank_name',
        'branch_name',
        'ifsc_code',
        'account_number',
        'pan_card_number',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
