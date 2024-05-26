<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Facades\Validator;

class AreasController extends Controller
{
    // INDEX
    public function index()
    {
        $areas = Area::all();
        return response()->json($areas, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $area = Area::findOrFail($id);
            return response()->json($area);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    // STORE
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $area = Area::create([
                'name' => $request->name,
            ]);

            return response()->json($area, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $area = Area::findOrFail($id);
            $area->update([
                'name' => $request->name,
            ]);

            return response()->json($area, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $area = Area::findOrFail($id);
            $area->delete();
            return response()->json('Area deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
