<?php

namespace App\Models;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes, Sluggable;

    public $table = 'sections';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'key',
        'year_experience',
        'short_description',
        'description',
        'features',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot ()
    {
        parent::boot();
        static::creating(function(Section $model) {
            $model->created_by = auth()->user()->id;
        });
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function sectionImage1()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','section-image1');
    }
    public function sectionImage2()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','section-image2');
    }

    public function getImage1UrlAttribute()
    {
        if($this->sectionImage1){
            return $this->sectionImage1->file_url;
        }
        return "";
    }
    public function getImage2UrlAttribute()
    {
        if($this->sectionImage2){
            return $this->sectionImage2->file_url;
        }
        return "";
    }



}
