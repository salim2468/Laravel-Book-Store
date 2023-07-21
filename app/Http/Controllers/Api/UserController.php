<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    //
    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => ['required','email'],
            'password' => ['required','min:4'],
        ]);

        $user = User::create($validatedData);
        $token = $user->createToken("auth_token")->accessToken;

        return response()->json(
            [
                'token' => $token,
                'user' => $user,
                'message' => 'User created successfully',
                'status' => 1
            ]
        );
    }

    public  function login(Request $request){

        $validatedData = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]); 
        // echo($request->email);
        // die();
        
        // $allUser = User::all();
        // return $allUser;
        
        $user = User::where('email',$request->email)->first();
        

        if($user){
            $token = $user->createToken("auth_token")->accessToken;
            return response()->json(
                [
                    'token' => $token,
                    'user' => $user,
                    'message' => 'Logined successfully.',
                    'status' => 1
                ]
            );
         }
    }


    public function getUser($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(
                [
                    'user' => null,
                    'message' => 'User not exist.',
                    'status' => 1
                ]
            );
        }else{
            return response()->json(
                [
                    'user' => $user,
                    'message'   => 'User found',
                    'status' => 1
                ]
            );
        }   

    }

   


    public function getAllUser(){
        $user = User::all();
        if(is_null($user)){
            return response()->json(
                [
                    'user' => null,
                    'message' => 'User not exist.',
                    'status' => 1
                ]
            );
        }else{
            return response()->json(
                [
                    'user' => $user,
                    'message'   => 'User found',
                    'status' => 1
                ]
            );
        }   

    }
}
