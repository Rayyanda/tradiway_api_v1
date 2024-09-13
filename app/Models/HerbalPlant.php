<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HerbalPlant extends Model
{
    use HasFactory;
    protected $table = "herbal_plants";
    protected $fillable = [
        'drink_id',
        'plant_id',
        'measurement'
    ];

    public function drinks():HasMany
    {
        return $this->hasMany(HerbalDrink::class,'id','drink_id');
    }

    public function plants()
    {
        return $this->hasMany(Plant::class,'id',  'plant_id');
    }
}
