<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
     
        'latin_name',
        'image_url',
        'savour'
    ];
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('/storage/images/user/' . $image),
        );
    }
}
