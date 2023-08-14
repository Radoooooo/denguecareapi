<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $userData = [
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
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        $user =  User::whereEmail($request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 422);
        }

        $token = $user->createToken('denguecareapi')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function adminregister(AdminRegisterRequest $request)
    {
        $request->validated();

        $adminData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $admin = Admin::create($adminData);
        $token = $admin->createToken('denguecareapi')->plainTextToken;
        return response([
            'admin' => $admin,
            'token' => $token,
        ], 201);
    }

    public function adminlogin(AdminLoginRequest $request)
    {
        $request->validated();

        $admin =  Admin::whereEmail($request->email)->first();


        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 422);
        }

        $token = $admin->createToken('denguecareapi')->plainTextToken;

        return response([
            'admin' => $admin,
            'token' => $token,
        ], 200);

    }

    public function logout()
    {
        Auth::logout();
        return response([
            'message' => "Logout success."
        ], 200);
    }
}
