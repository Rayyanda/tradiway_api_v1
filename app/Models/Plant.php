<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Casts\AsStringable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'slug',
        'benefits',
        'latin_name',
        'image_url',
        'content'
    ];

    // /**
    //  * Get the attributes that should be cast.
    //  *
    //  * @return array<string, string>
    //  */
    // protected function casts(): array
    // {
    //     return [
    //         'content' => AsStringable::class,
    //     ];
    // }

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->slug = Str::slug($model->name);
        });
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('/storage/images/user/' . $image),
        );
    }

    public function herbal_plant_through()
    {
        return $this->through('herbal_plant')->has('drinks');
    }

    public function herbal_plant():HasMany
    {
        return $this->hasMany(HerbalPlant::class,'');
    }

    public function drinks():BelongsTo
    {
        return $this->belongsTo(HerbalPlant::class, 'plant_id','id');
    }
}
