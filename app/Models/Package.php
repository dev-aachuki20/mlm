<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Package extends Model
{
    use SoftDeletes;

    public $table = 'package';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'level_one_commission',
        'level_two_commission',
        'level_three_commission',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
