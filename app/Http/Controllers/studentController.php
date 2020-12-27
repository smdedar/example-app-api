<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

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

    public function student($id){
        //dd($id);
        if(Student::where('id', $id)->exists()){
            $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            //dd($student);
            return response($student,200);
        } else{
            //return 'Not Found';
            return response()->json([
                "message" => "Student Not Found",
            ], 400);
        }
    }


    public function delete(Request $request, $id){
        if(Student::where('id', $id)->exists()){
            $student = Student::find($id);
            $student -> delete();

            return response()->json([
                "message" => "Student Record Delete Successfully"
            ], 202);
        }else{
            return response()->json([
                "message" => "Student Not Found",
            ], 404);
        }
    }
}
