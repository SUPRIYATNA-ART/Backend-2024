<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();

        return response()->json([
            'message' => 'Menampilkan seluruh resource',
            'data' => $pegawai,
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'gender' => 'required|in:M,F',
                'phone' => 'required|string|max:15',
                'address' => 'required|string',
                'email' => 'required|email|unique:pegawai|max:255',
                'status' => 'required|in:active,inactive',
                'hired_on' => 'required|date',
            ]);

            $pegawai = Pegawai::create($request->all());

            return response()->json([
                'message' => 'Resource is added successfully',
                'data' => $pegawai,
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation Error',
                'message' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menambahkan pegawai',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);

            return response()->json([
                'message' => 'Get Detail Resource',
                'data' => $pegawai,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'string|max:255',
                'gender' => 'in:M,F',
                'phone' => 'string|max:15',
                'address' => 'string',
                'email' => 'email|unique:pegawai,email,' . $id,
                'status' => 'in:active,inactive',
                'hired_on' => 'date',
            ]);

            $pegawai = Pegawai::findOrFail($id);
            $pegawai->update($request->all());

            return response()->json([
                'message' => 'Resource is updated successfully',
                'data' => $pegawai,
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation Error',
                'message' => $e->errors(),
            ], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);

            if ($pegawai->status !== 'active') {
                return response()->json(['message' => 'Only active resources can be deleted'], 403);
            }

            $pegawai->delete();
            return response()->json(['message' => 'Resource is deleted successfully'], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Resource not found'], 404);
        }
    }

    public function search($name)
    {
        $pegawai = Pegawai::where('name', 'like', '%' . $name . '%')->get();

        if ($pegawai->isEmpty()) {
            return response()->json(['message' => 'Resource not found'], 404);
        } else {
            return response()->json([
                'message' => 'Get searched resource',
                'data' => $pegawai,
            ], 200);
        }
    }

    public function active()
    {
        $pegawai = Pegawai::where('status', 'active')->get();

        return response()->json([
            'message' => 'Get active resources',
            'total' => $pegawai->count(),
            'data' => $pegawai,
        ], 200);
    }

    public function inactive()
    {
        $pegawai = Pegawai::where('status', 'inactive')->get();

        return response()->json([
            'message' => 'Get inactive resources',
            'total' => $pegawai->count(),
            'data' => $pegawai,
        ], 200);
    }
}
