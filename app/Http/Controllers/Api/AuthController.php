<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Casts\Json;

class AuthController extends Controller
{
    //register
    public function register(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user uuid
        $user_id = Str::uuid();

        //create user
        $user = User::create([
            'user_id'   => $user_id,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => hash::make($request->password),
            'role'      => "customer"
        ]);

        //create customer
        $customer = Customer::create([
            'customer_id' => Str::uuid(),
            'user_id'     => $user_id,
        ]);

        //return response JSON user is created
        if($user) {
            return response()->json([
                'success' => true,
                'data'    => ['user'=> $user, 'customer'=>$customer],  
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'success' => false,
        ], 409);
    }

    /**
     * Summary of login
     * @param \Illuminate\Http\Request $request
     * 
     */
    public function login(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return response()->json([
                'message' => "Login Successfully"
            ], 200);
        }
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json([
            'message' => 'Logout Successfully'
        ],200);
    }

    public function user(Request $request)
    {
        return response()->json([$request->user()],200);
    }
}
