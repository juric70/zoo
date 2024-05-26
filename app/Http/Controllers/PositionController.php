<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    // INDEX
    public function index()
    {
        $positions = Position::all();
        return response()->json($positions, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $position = Position::findOrFail($id);
            return response()->json($position);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    // STORE
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $position = Position::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json($position, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $position = Position::findOrFail($id);
            $position->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json($position, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $position = Position::findOrFail($id);
            $position->delete();
            return response()->json('Position deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
