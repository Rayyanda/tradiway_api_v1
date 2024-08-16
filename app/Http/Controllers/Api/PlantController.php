<?php

namespace App\Http\Controllers\Api;

use App\Models\Plant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlantResource;
use Illuminate\Support\Facades\Validator;

class PlantController extends Controller
{
    //index
    public function index()
    {
        $plants = Plant::all();

        return new PlantResource(true,'Plant data',$plants);
    }

    /**
     * store
     * 
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'      => 'string|required',
            'latin_name' => 'nullable',
            'description' => 'nullable',
            'image_url' => 'nullable',
            'savour' => 'nullable|array',
            'savour.*' => 'string'
        ]);

        //check if validation fails
         if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/images/plants', $image->hashName());

        //toJson
        $savour = json_encode($request->savour);

        //create new plant
        $plant = Plant::create([
            'name'      => $request->name,
            'slug'      => Str::slug($request->name),
            'latin_name' => $request->latin_name,
            'description' => $request->description,
            'image_url' => $image->hashName(),
            'savour' => $savour
        ]);

        return new PlantResource(true,'Data stored',$plant);
    }
}
