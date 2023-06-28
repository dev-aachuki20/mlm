<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'pages';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'parent_page_id',
        'title',
        'sub_title',
        'slug',
        'type',
        'description',
        'template_name',
        'created_by'
    ];

    protected static function boot () 
    {
        parent::boot();
        static::creating(function(Page $model) {
            $model->created_by = auth()->user()->id;
            $model->slug = $model->generateSlug($model->title);
        });            
        
        static::updating(function (Page $model) {
            if($model->type != 3){
                $model->slug = $model->generateSlug($model->title);
            }
           
        });
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function sliderImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','page-slider');
    }

    public function getSliderImageUrlAttribute()
    {
        if($this->sliderImage){
            return $this->sliderImage->file_url;
        }
        return "";
    }

}
