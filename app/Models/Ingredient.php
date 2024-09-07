<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant_id',
        'drink_id',
        'measure'
    ];

    public function plant():BelongsToMany
    {
        return $this->belongsToMany(Plant::class, 'ingredients','plant_id','drink_id');
    }

    public function herbal_drink():BelongsTo
    {
        return $this->belongsTo(HerbalDrink::class, 'id','id');
    }

    public function drinks():HasMany
    {
        return $this->hasMany(HerbalDrink::class,'id','id');
    }
}
