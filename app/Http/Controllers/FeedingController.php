<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feeding;
use Illuminate\Support\Facades\Validator;

class FeedingController extends Controller
{
    // INDEX
    public function index()
    {
        $feedings = Feeding::all();
        return response()->json($feedings, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $feeding = Feeding::findOrFail($id);
            return response()->json($feeding);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    // STORE
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'employee_id' => 'required|exists:employees,id',
                'food_id' => 'required|exists:food,id',
                'accommodation_id' => 'required|exists:accomodations,id',
                'feeding_time' => 'required|date_format:Y-m-d H:i:s',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $feeding = Feeding::create([
                'employee_id' => $request->employee_id,
                'food_id' => $request->food_id,
                'accommodation_id' => $request->accommodation_id,
                'feeding_time' => $request->feeding_time,
            ]);

            return response()->json($feeding, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'employee_id' => 'required|exists:employees,id',
                'food_id' => 'required|exists:food,id',
                'accommodation_id' => 'required|exists:accomodations,id',
                'feeding_time' => 'required|date_format:Y-m-d H:i:s',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $feeding = Feeding::findOrFail($id);
            $feeding->update([
                'employee_id' => $request->employee_id,
                'food_id' => $request->food_id,
                'accommodation_id' => $request->accommodation_id,
                'feeding_time' => $request->feeding_time,
            ]);

            return response()->json($feeding, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $feeding = Feeding::findOrFail($id);
            $feeding->delete();
            return response()->json('Feeding deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
