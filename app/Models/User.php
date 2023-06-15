<?php

namespace App\Models;

use Hash;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable, Impersonate;

    protected $guard = 'web';

    public $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'password',
        'dob',
        'date_of_join',
        'my_referral_code',
        'referral_code',
        'referral_name',
        'referral_user_id',
        'password_set_at',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'is_active',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function kycDetail()
    {
        return $this->hasOne(Kyc::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

     /**
     * @return bool
     */
    public function canImpersonate()
    {
        if(in_array(auth()->user()->roles->first()->id, ['1','2','3'])){
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        if(in_array($this->roles->first()->id, ['1','2'])){
            return false;
        }
        return true;
    }

    public function getIsSuperAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 2)->exists();
    }

    public function getIsUserAttribute()
    {
        return $this->roles()->where('id', 3)->exists();
    }

    public function profileImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','profile');
    }

    public function getProfileImageUrlAttribute()
    {
        if($this->profileImage){
            return $this->profileImage->file_url;
        }
        return "";
    }
   

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referral_user_id');
    }

    public function level2Referrer()
    {
        return $this->belongsTo(User::class, 'referral_user_id')
                    ->with('referrer');
    }

    public function level3Referrer()
    {
        return $this->belongsTo(User::class, 'referral_user_id')
                    ->with('level2Referrer.referrer');
    }
}
