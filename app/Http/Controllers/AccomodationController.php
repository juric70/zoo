<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accomodation;
use Illuminate\Support\Facades\Validator;

class AccomodationController extends Controller
{
    // INDEX
    public function index()
    {
        $accommodations = Accomodation::all();
        return response()->json($accommodations, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $accommodation = Accomodation::findOrFail($id);
            return response()->json($accommodation);
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
                'capacity' => 'required|integer|min:1',
                'area_id' => 'required|exists:areas,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $accommodation = Accomodation::create([
                'name' => $request->name,
                'capacity' => $request->capacity,
                'area_id' => $request->area_id,
            ]);

            return response()->json($accommodation, 201);
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
                'capacity' => 'required|integer|min:1',
                'area_id' => 'required|exists:areas,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $accommodation = Accomodation::findOrFail($id);
            $accommodation->update([
                'name' => $request->name,
                'capacity' => $request->capacity,
                'area_id' => $request->area_id,
            ]);

            return response()->json($accommodation, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $accommodation = Accomodation::findOrFail($id);
            $accommodation->delete();
            return response()->json('Accommodation deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
