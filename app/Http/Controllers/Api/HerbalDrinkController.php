<?php

namespace App\Http\Controllers\Api;

use App\Models\HerbalDrink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HerbalDrinkResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class HerbalDrinkController extends Controller
{
    //
    public function index()
    {
        $herbalDrinks = HerbalDrink::all();
        $ingre = [];
        foreach ($herbalDrinks as $value) {
            $ingre = $value->composition;
        }
        return new HerbalDrinkResource(true,'Drinks',[
            'drinks' => $herbalDrinks,
        ]);
    }
    

    public function show($slug)
    {
        $herbaldrink = HerbalDrink::where('slug','=',$slug)->first();
        $herbaldrink->composition;
        return new HerbalDrinkResource(
            true,
            'drinks',
            [
                'drink' => $herbaldrink,
            ]
        );
    }
}
