<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Http\Resources\StudentResource;

class StudentsController extends Controller
{
    public function register( Request $request ){
        $data = $request->validate([
            'firstName'     =>'required',
            'lastName'      =>'required',
            'email'         =>'required',
            'avatar'        =>'sometimes',
        ]);

        $student = Students::whereEmail($data['email'])->first();
        if($student){
            abort(400, "This email already exists");
        }

        $student = Students::create([
            'first_name'    => $data['firstName'],
            'last_name'     => $data['lastName'],
            'email'         => $data['email'],
            'avatar'        => optional($data)['avatar'],
        ]);

        return new StudentResource($student);
    }

    public function get( Request $request ){
        $all = Students::latest()->get();
        return StudentResource::collection($all);
    }

    public function find ( Request $request){

        $data = $request->validate([
            'id' => "required",
        ]);

        $student = Students::whereId($data['id'])->first();

        return new StudentResource($student);
    }

    public function update(Request $request ){
        $data = $request->validate([
            'firstName'     =>'required',
            'lastName'      =>'required',
            'email'         =>'required',
            'avatar'        =>'sometimes',
            'id'            =>'required',
        ]);
        
        $student = Students::whereId($data['id'])->first();

        if(isset($student)){
            $student->update([
                'first_name'    => $data['firstName'],
                'last_name'     => $data['lastName'],
                'email'         => $data['email'],
                'avatar'        => optional($data)['avatar'],
            ]);
        }

        return new StudentResource($student);

    }
}
