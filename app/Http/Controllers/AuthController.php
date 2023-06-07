<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login( Request $request ){
        $data = $request->validate([
            'email'         => ['required', 'email'],
            'password'      => 'required',
        ]);

        $user = User::whereEmail($data['email'])->first();
        if(!$user){
            abort(400, "This user does not exist");
        }

        if (Auth::attempt($data)) {
            return new UserResource($user);
        }

        return ['message' => 'Invalid credentials'];
    }
}
