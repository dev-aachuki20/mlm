<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Package extends Model
{
    use SoftDeletes;

    public $table = 'package';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'amount',
        'description',
        'level_one_commission',
        'level_two_commission',
        'level_three_commission',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot () 
    {
        parent::boot();
        static::creating(function(Package $model) {
            $model->created_by = auth()->user()->id;
        });               
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function packageImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','package');
    }

    public function getImageUrlAttribute()
    {
        if($this->packageImage){
            return $this->packageImage->file_url;
        }
        return "";
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'package_user');
    }
}
