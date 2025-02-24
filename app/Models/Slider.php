<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Slider extends Model
{
    use SoftDeletes;

    public $table = 'slider';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type',
        'status',
        'created_by',
    ];

    protected static function boot () 
    {
        parent::boot();
        static::creating(function(Slider $model) {
            $model->created_by = auth()->user()->id;
        });               
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function sliderImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','slider');
    }

    public function getImageUrlAttribute()
    {
        if($this->sliderImage){
            return $this->sliderImage->file_url;
        }
        return "";
    }
}
