<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

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
        'duration',
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
            Cache::forget('all_lectures_'.$model->course_id);
        });    
        
        static::creating(function (VideoGroup $model) {
            $model->slug = $model->generateSlug($model->title);
        });

        static::updating(function (VideoGroup $model) {
            $model->slug = $model->generateSlug($model->title);
        });

        static::deleted(function ($model) {
            Cache::forget('all_lectures_'.$model->course_id);
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

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
