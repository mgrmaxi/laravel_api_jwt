<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Response;

class APIRegisterController extends Controller
{
    //

    public function register( Request $request ){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);
        if( $validator->failed()){

            return Response()->json($validator->errors());
        }
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt ($request->get('password')),
        ]);

        $user=User::first();
        $token =JWTAuth::fromUser($user);
        return Response()->json(compact('token'));


}



}
