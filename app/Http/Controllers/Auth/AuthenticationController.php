<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request){
        $request->validated();

        $userData=[
            'name' => $request->name,
            'age' => $request->age,
            'sex' => $request->sex,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::create($userData);
        $token = $user->createToken('denguecareapi')->plainTextToken;
        return response([
            'user' => $user,
            'token'=>$token,
        ],201);
    }

    public function login(LoginRequest $request){
        $request->validated();

        $user =  User::whereEmail($request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return response([
                'message' => 'Invalid credentials'
            ],422);
        }

        $token = $user->createToken('denguecareapi')->plainTextToken;

        return response([
            'user' => $user,
            'token'=>$token,
        ],200);
    }
}
