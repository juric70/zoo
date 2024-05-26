<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{
    // INDEX
    public function index()
    {
        $maintenances = Maintenance::all();
        return response()->json($maintenances, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $maintenance = Maintenance::findOrFail($id);
            return response()->json($maintenance);
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
                'accommodation_id' => 'required|exists:accomodations,id',
                'maintenance_time' => 'required|date_format:Y-m-d H:i:s',
                'maintenance_type_id' => 'required|exists:maintenance_types,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $maintenance = Maintenance::create([
                'employee_id' => $request->employee_id,
                'accommodation_id' => $request->accommodation_id,
                'maintenance_time' => $request->maintenance_time,
                'maintenance_type_id' => $request->maintenance_type_id,
            ]);

            return response()->json($maintenance, 201);
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
                'accommodation_id' => 'required|exists:accomodations,id',
                'maintenance_time' => 'required|date_format:Y-m-d H:i:s',
                'maintenance_type_id' => 'required|exists:maintenance_types,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $maintenance = Maintenance::findOrFail($id);
            $maintenance->update([
                'employee_id' => $request->employee_id,
                'accommodation_id' => $request->accommodation_id,
                'maintenance_time' => $request->maintenance_time,
                'maintenance_type_id' => $request->maintenance_type_id,
            ]);

            return response()->json($maintenance, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $maintenance = Maintenance::findOrFail($id);
            $maintenance->delete();
            return response()->json('Maintenance deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
