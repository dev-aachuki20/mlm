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
        });            
        
        static::creating(function (Page $model) {
            $model->slug = $model->generateSlug($model->title);
        });

        static::updating(function (Page $model) {
            $model->slug = $model->generateSlug($model->title);
        });
    }

}
