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
        'other_json',
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

    protected static function boot ()
    {
        parent::boot();
        
        static::deleting(function ($model) {
            // Delete all associated courses and their video groups
            $model->profile()->delete();
            $model->kycDetail()->delete();
            $model->payments()->delete();
            $model->refferalTransaction()->delete();
        });
    }

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
        if (in_array(auth()->user()->roles->first()->id, ['1', '2', '3', '4', '5'])) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        if (in_array($this->roles->first()->id, ['1', '2'])) {
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

    public function getIsCeoAttribute()
    {
        return $this->roles()->where('id', 4)->exists();
    }

    public function getIsManagementAttribute()
    {
        return $this->roles()->where('id', 5)->exists();
    }

    public function profileImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type', 'profile');
    }

    public function getProfileImageUrlAttribute()
    {
        if ($this->profileImage) {
            return $this->profileImage->file_url;
        }
        return "";
    }

    public function aadharFrontImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type', 'aadhar-card-front');
    }

    public function getAadharFrontImageUrlAttribute()
    {
        if ($this->aadharFrontImage) {
            return $this->aadharFrontImage->file_url;
        }
        return "";
    }

    public function aadharBackImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type', 'aadhar-card-back');
    }

    public function getAadharBackImageUrlAttribute()
    {
        if ($this->aadharBackImage) {
            return $this->aadharBackImage->file_url;
        }
        return "";
    }

    public function panCardImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type', 'pancard');
    }

    public function getPancardImageUrlAttribute()
    {
        if ($this->panCardImage) {
            return $this->panCardImage->file_url;
        }
        return "";
    }

    public function getPlanPurchasedAttribute()
    {
        $planPurchased = $this->payments()->where('payment_type','plan purchased')->value('payment_approval');

        return $planPurchased;
    }

    public function team()
    {
        return $this->hasMany(User::class, 'referral_user_id', 'id');
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class, 'created_by');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referral_user_id');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_user');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'user_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'referrer_id', 'id');
    }

    public function refferalTransaction(){
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }
}
