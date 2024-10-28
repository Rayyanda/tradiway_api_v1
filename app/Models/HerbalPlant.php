<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HerbalPlant extends Model
{
    use HasFactory;
    protected $table = "herbal_plants";
    protected $fillable = [
        'drink_id',
        'plant_id',
        'measurement'
    ];

    //multiple rows
    public function drinks():hasMany
    {
        return $this->hasMany(HerbalDrink::class,'id','drink_id');
    }

    //single row
    public function drink():HasOne
    {
        return $this->hasOne(HerbalDrink::class,'id','drink_id');
    }

    //multiple rows
    public function plants()
    {
        return $this->hasMany(Plant::class,'id',  'plant_id');
    }

    //single row
    public function plant():HasOne
    {
        return $this->hasOne(Plant::class, 'id','drink_id');
    }
}
