<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'courses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'package_id',
        'name',
        'slug',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot() 
    {
        parent::boot();
        static::creating(function(Course $model) {
            $model->created_by = auth()->user()->id;
        });    
        
        static::creating(function (Course $model) {
            $model->slug = $model->generateSlug($model->name);
        });

        static::updating(function (Course $model) {
            $model->slug = $model->generateSlug($model->name);
        });
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function courseImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','course-image');
    }

    public function getCourseImageUrlAttribute()
    {
        if($this->courseImage){
            return $this->courseImage->file_url;
        }
        return "";
    }

    public function courseVideo()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','course-video');
    }

    public function getCourseVideoUrlAttribute()
    {
        if($this->courseVideo){
            return $this->courseVideo->file_url;
        }
        return "";
    }


    public function videoGroup()
    {
        return $this->belongsToMany(VideoGroup::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }


}
