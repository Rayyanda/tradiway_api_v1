<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class HerbalDrink extends Model
{
    use HasFactory;

    protected $table = "herbal_drinks";
    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'benefits',
        'category',
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

    // protected $casts = [
    //     'ingredient' => 'array'
    // ];

    public function composition():HasManyThrough
    {
        return $this->through('herbal_plant')->has('plants');
    }

    public function herbal_plant()
    {
        return $this->hasMany(HerbalPlant::class, 'drink_id','id');
    }

    public function plant():BelongsTo
    {
        return $this->belongsTo(Plant::class);
    }

}
