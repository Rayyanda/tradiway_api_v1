<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Handle incoming request to get all customer
     * 
     * @return mixed
     */
    public function index()
    {
        //get all customer
        $customers = Customer::all();

        //return collection of customer as a resource
        return new CustomerResource(true,'Data Collected',$customers);
    }

    /**
     * Store
     * @return mixed $request
     */
    public function store(Request $request)
    {
        //validator
        $validator = Validator::make($request->all(),[
            'profile_pict' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'birth'        => 'nullable|date',
            'address'      => 'nullable|string',
            'phone'        => 'nullable',
        ]);

         //check if validation fails
        //  if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        if ($validator->fails()) {
            return new CustomerResource(false,$validator->errors()->first(),null);
        }
        //store customer
        $customer = Customer::where('user_id','=',auth()->user()->user_id)->first();

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/images/user', $image->hashName());

        $customer->update([
            'profile_pict' => $image->hashName(),
            'birth'        => $request->birth,
            'address'      => $request->address,
            'phone'        => $request->phone,
        ]);

        //return response
        return new CustomerResource(true,'Data Updated',$customer);
    }
}
