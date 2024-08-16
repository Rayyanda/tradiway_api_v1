<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HerbalDrink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'benefits',
        'category'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            if(empty($model->slug))
            {
                $model->slug = (string) Str::slug($model->name);
            }
        });
    }
}
