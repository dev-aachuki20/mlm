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
        'uuid',
        'title',
        'sub_title',
        'amount',
        'features',
        'description',
        'level_one_commission',
        'level_two_commission',
        'level_three_commission',
        'duration',
        'level',
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
        
        static::deleting(function ($model) {
            // Delete all associated courses and their video groups
            $model->courses->each(function ($course) {
                // Delete all associated video groups for the course
                $course->videoGroup->each(function ($videoGroup) {
                    $videoGroup->delete();
                });
                // Delete the course itself
                $course->delete();
            });
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

    public function packageVideo()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','package-video');
    }

    public function getVideoUrlAttribute()
    {
        if($this->packageVideo){
            return $this->packageVideo->file_url;
        }
        return "";
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'package_user');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'package_id', 'id');
    }
}
