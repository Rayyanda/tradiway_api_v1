<?php

namespace App\Http\Controllers\Api;

use App\Models\HerbalPlant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HerbalPlantResource;

class HerbalPlantController extends Controller
{
    //
    public function index()
    {
        $herbal_plants = HerbalPlant::all();
        return new HerbalPlantResource(true,'Herbal Plants',$herbal_plants);
    }

    public function getByDrinks($drink_id)
    {
        $composition = HerbalPlant::where('drink_id','=',$drink_id)->get();
        foreach ($composition as $key) {
            # code...
          $key->plants;
        }
        return new HerbalPlantResource(true,'Herbal Plants',[
            'herbal_plants'=>$composition,
        ]);
    }

    public function getByPlants($plant_id)
    {
        $drinks = HerbalPlant::where('plant_id','=',$plant_id)->get();
        foreach($drinks as $key)
        {
            $key->drinks;
        }
        return new HerbalPlantResource(true,'Herbal Plants',[
            'herbal_drinks' => $drinks
        ]);
    }
}
