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
}
