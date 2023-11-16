<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    public $table = 'services';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'sub_title',
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
        static::creating(function(Service $model) {
            $model->created_by = auth()->user()->id;
        });
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function serviceImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type','services');
    }

    public function getImageUrlAttribute()
    {
        if($this->serviceImage){
            return $this->serviceImage->file_url;
        }
        return "";
    }

}
