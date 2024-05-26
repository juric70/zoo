<?php

namespace App\Http\Controllers;

use App\Models\AnimalTypes;
use Illuminate\Http\Request;
use App\Models\AnimalType;
use Illuminate\Support\Facades\Validator;

class AnimalTypesController extends Controller
{
    // INDEX
    public function index()
    {
        $animalTypes = AnimalTypes::all();
        return response()->json($animalTypes, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $animalType = AnimalTypes::findOrFail($id);
            return response()->json($animalType);
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
                'feeding_type' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $animalType = AnimalTypes::create([
                'name' => $request->name,
                'description' => $request->description,
                'feeding_type' => $request->feeding_type,
            ]);

            return response()->json($animalType, 201);
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
                'feeding_type' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $animalType = AnimalTypes::findOrFail($id);
            $animalType->update([
                'name' => $request->name,
                'description' => $request->description,
                'feeding_type' => $request->feeding_type,
            ]);

            return response()->json($animalType, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $animalType = AnimalTypes::findOrFail($id);
            $animalType->delete();
            return response()->json('Animal type deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
