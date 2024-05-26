<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animals;
use Illuminate\Support\Facades\Validator;

class AnimalsController extends Controller
{
    // INDEX
    public function index()
    {
        $animals = Animals::all();
        return response()->json($animals, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $animal = Animals::findOrFail($id);
            return response()->json($animal);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    // STORE
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'date_of_birth' => 'required|date|before_or_equal:today',
                'country_of_origin' => 'nullable|string|max:255',
                'acquisition_date' => 'required|date|before_or_equal:today',
                'special_notes' => 'nullable|string',
                'accommodation_id' => 'required|exists:accomodations,id',
                'animal_type_id' => 'required|exists:animal_types,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $animal = Animals::create([
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'country_of_origin' => $request->country_of_origin,
                'acquisition_date' => $request->acquisition_date,
                'special_notes' => $request->special_notes,
                'accommodation_id' => $request->accommodation_id,
                'animal_type_id' => $request->animal_type_id,
            ]);

            return response()->json($animal, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'date_of_birth' => 'required|date|before_or_equal:today',
                'country_of_origin' => 'nullable|string|max:255',
                'acquisition_date' => 'required|date|before_or_equal:today',
                'special_notes' => 'nullable|string',
                'accommodation_id' => 'required|exists:accomodations,id',
                'animal_type_id' => 'required|exists:animal_types,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $animal = Animals::findOrFail($id);
            $animal->update([
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'country_of_origin' => $request->country_of_origin,
                'acquisition_date' => $request->acquisition_date,
                'special_notes' => $request->special_notes,
                'accommodation_id' => $request->accommodation_id,
                'animal_type_id' => $request->animal_type_id,
            ]);

            return response()->json($animal, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $animal = Animals::findOrFail($id);
            $animal->delete();
            return response()->json('Animal deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
