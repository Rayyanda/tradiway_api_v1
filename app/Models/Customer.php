<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $primaryKey = "customer_id";
    protected $keyType = "string";
    public $incrementing = false;
    protected $fillable = [
        'customer_id',
        'user_id',
        'profile_pict',
        'birth',
        'address',
        'phone',
    ];

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('/storage/images/user/' . $image),
        );
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
