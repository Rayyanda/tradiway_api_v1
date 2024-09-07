<?php

namespace App\Http\Controllers\Api;

use App\Models\HerbalDrink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HerbalDrinkResource;

class HerbalDrinkController extends Controller
{
    //
    public function index()
    {
        $herbalDrinks = HerbalDrink::all();
        //$ingre = $herbalDrinks->ingredient;
        return new HerbalDrinkResource(true,'Drinks',[
            'drinks' => $herbalDrinks,
        ]);
    }
    

    public function show($id)
    {
        $herbaldrink = HerbalDrink::find($id)->first();
        $resource = $herbaldrink->herbal_plants;
        
        return new HerbalDrinkResource(
            true,
            'drinks',
            [
                'drink' => $herbaldrink,
                'plants' => $resource
            ]
        );
    }
}
