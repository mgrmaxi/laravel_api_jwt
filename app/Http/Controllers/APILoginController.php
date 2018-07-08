<?php

namespace App\Http\Controllers;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use Illuminate\Http\Support\Facades\Auth;
use App\User;
use JWTFactory;
use JWTAuth;
use Illuminate\Support\Facades\Validator;


class APILoginController extends Controller
{
    //
 public function login( Request $request ){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);
        if( $validator->failed()){

            return Response()->json($validator->errors());
        }
       
       $credantial = $request->only('email','password');

       try{
           if(!$token =JWTAuth::attempt($credantial)){
                return response()->json(['error'=>'inviled username or password'],[401]);
             } 
         }
       catch(JWTExcption $e){
                return response()->json(['error'=>'could not make token'],[500]);
       }

     return response()->json(compact ('token'));
}

}
