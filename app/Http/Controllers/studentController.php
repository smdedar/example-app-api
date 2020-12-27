<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;

class studentController extends Controller
{
    //

    public function index(){
        //return view('welcome');
        //$student = Student::all()->toJson(JSON_PRETTY_PRINT);
        //dd($student);
        //return $student;

        $students = Student::get()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
    }

    public function add(Request $request){
        $token = $request->session()->token();
        $token = csrf_token();
        
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json([
            "message" => "student record created"
        ], 201);
    }


}
