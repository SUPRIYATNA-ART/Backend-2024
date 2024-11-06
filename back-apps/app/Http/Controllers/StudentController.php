<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->isNotEmpty()) {
            $response = [
                'message' => 'Successfully viewed all students',
                'data' => $students,
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'No students found'
            ];

            return response()->json($response, 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' =>'required|string|max:255',
            'nim' =>'required|string|max:255|unique:student',
            'email' =>'required|email|unique:student',
            'jurusan' =>'required|string|max:255',

        ]);

        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        $student = Student::create($input);

        $data = [
            'message' => 'Student created successfully',
            'data' => $student
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student) {
            $input = [
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan
            ];

            $student->update($input);

            $data = [
                'message' => 'Student updated successfully',
                'data' => $student
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();

            $data = [
                'message' => 'Student deleted successfully'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];

            return response()->json($data, 404);
        }
    }

    public function show($id)
    {
        $student = Student::find($id);

        if ($student) {
            $data = [
                'message' => 'Student details retrieved successfully',
                'data' => $student
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => "Student with ID $id not found"
            ];

            return response()->json($data, 404);
        }
    }
}
