<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function index(){
        $students = Student::all();
        if ($students->isEmpty()){
            $data = [
                'message' => 'No data found',
                'status' => 200
            ];
            return response()->json($data, $data['status']);
        }
        $data = [
            'students' => $students,
            'status' => 200
        ];
        return response()->json($data,$data['status']);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
           'name' => 'required',
           'email' => 'required|email',
           'phone' => 'required',
           'language' => 'required'
        ]);

        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, $data['status']);
        }

        $student = Student::created([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'language' => $request->language
        ]);

        if (!$student){
            $data = [
                'message' => 'Error al crear un estudiante',
                'status' => 500
            ];
            return response()->json($data, $data['status']);
        }

        $data = [
            'student' => $student,
            'status' => 201
        ];
        return response()->json($data, $data['status']);
    }
}
