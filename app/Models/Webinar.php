<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webinar extends Model
{
    use SoftDeletes;

    public $table = 'webinars';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'date',
        'time',
        'presenter',
        'description',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot () 
    {
        parent::boot();
        static::creating(function(Webinar $model) {
            $model->created_by = auth()->user()->id;
        });               
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function webinarImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','webinar');
    }

    public function getImageUrlAttribute()
    {
        if($this->webinarImage){
            return $this->webinarImage->file_url;
        }
        return "";
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}
