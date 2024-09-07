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

    public function drinks():BelongsTo
    {
        return $this->belongsTo(HerbalDrink::class,'drink_id','id');
    }

    public function plants()
    {
        return $this->belongsTo(Plant::class,'plant_id','id');
    }
}
