<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class VideoGroup extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'video_groups';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot() 
    {
        parent::boot();
        static::creating(function(VideoGroup $model) {
            $model->created_by = auth()->user()->id;
        });    
        
        static::creating(function (VideoGroup $model) {
            $model->slug = $model->generateSlug($model->title);
        });

        static::updating(function (VideoGroup $model) {
            $model->slug = $model->generateSlug($model->title);
        });
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function courseVideo()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','video-group');
    }

    public function getCourseVideoUrlAttribute()
    {
        if($this->courseVideo){
            return $this->courseVideo->file_url;
        }
        return "";
    }

    public function courseVideoBanner()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','video-group-banner');
    }

    public function getCourseVideoBannerUrlAttribute()
    {
        if($this->courseVideo){
            return $this->courseVideo->file_url;
        }
        return "";
    }

    public function courseImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','video-group-image');
    }

    public function getCourseImageUrlAttribute()
    {
        if($this->courseVideo){
            return $this->courseVideo->file_url;
        }
        return "";
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
