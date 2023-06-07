<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function register( Request $request ){
        $data = $request->validate([
            'firstName'     =>'required',
            'lastName'      =>'required',
            'email'         =>'required',
            'password'      =>'required',
            'username'      =>'required',
        ]);

        $user = User::whereEmail($data['email'])->first();
        if($user){
            abort(400, "This email already exists");
        }

        $user = User::create([
            'first_name'    => $data['firstName'],
            'last_name'     => $data['lastName'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'username'      => $data['username'],
        ]);

        return new UserResource($user);
    }
}
