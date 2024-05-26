<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceType;
use Illuminate\Support\Facades\Validator;

class MaintenanceTypeController extends Controller
{
    // INDEX
    public function index()
    {
        $maintenanceTypes = MaintenanceType::all();
        return response()->json($maintenanceTypes, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $maintenanceType = MaintenanceType::findOrFail($id);
            return response()->json($maintenanceType);
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

            $maintenanceType = MaintenanceType::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json($maintenanceType, 201);
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

            $maintenanceType = MaintenanceType::findOrFail($id);
            $maintenanceType->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json($maintenanceType, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $maintenanceType = MaintenanceType::findOrFail($id);
            $maintenanceType->delete();
            return response()->json('Maintenance type deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
