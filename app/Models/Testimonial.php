<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    public $table = 'testimonial';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'designation',
        'description',
        'rating',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot () 
    {
        parent::boot();
        static::creating(function(Testimonial $model) {
            $model->created_by = auth()->user()->id;
        });               
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }


    public function testimonialImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','testimonial');
    }

    public function getImageUrlAttribute()
    {
        if($this->testimonialImage){
            return $this->testimonialImage->file_url;
        }
        return "";
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
