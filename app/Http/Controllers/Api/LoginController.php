<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    // public function __invoke(Request $request)
    // {
    //     //set validation
    //     $validator = Validator::make($request->all(), [
    //         'email'     => 'required',
    //         'password'  => 'required'
    //     ]);

    //     //if validation fails
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     //get credentials from request
    //     $credentials = $request->only('email', 'password');

    //     //if auth failed
    //     if(!$token = auth()->guard('api')->attempt($credentials)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Email atau Password Anda salah'
    //         ], 401);
    //     }

    //     //if auth success
    //     return response()->json([
    //         'success' => true,
    //         'user'    => auth()->guard('api')->user(),    
    //         'token'   => $token   
    //     ], 200)->cookie('token',$token,60, '/',null, true, true);
    // }

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

        //if auth failed
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        //if auth success
        return response()
        ->json([
            'success' => true,
            //'user'    => auth()->guard('api')->user(),    
            'token'   => $token   
        ], 200)
        ->cookie('token',$token,60, '/',null, true, true);

        //return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
         // Menggunakan config untuk mendapatkan TTL
         $ttl = config('jwt.ttl');
        
         $cookie = cookie('jwt', $token, $ttl, null, null, true, true, false, 'strict');
 
         return response()->json(['message' => 'Login successful'])
             ->withCookie($cookie);
        // $cookie = cookie('jwt', $token, Auth::factory()->getTTL(), null, null, true, true, false, 'strict');

        // return response()->json(['message' => 'Login successful'])
        //     ->withCookie($cookie);
    }
}