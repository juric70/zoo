<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    // INDEX
    public function index()
    {
        $foods = Food::all();
        return response()->json($foods, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $food = Food::findOrFail($id);
            return response()->json($food);
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
                'type' => 'required|max:255',
                'quantity' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $food = Food::create([
                'name' => $request->name,
                'type' => $request->type,
                'quantity' => $request->quantity,
            ]);

            return response()->json($food, 201);
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
                'type' => 'required|max:255',
                'quantity' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $food = Food::findOrFail($id);
            $food->update([
                'name' => $request->name,
                'type' => $request->type,
                'quantity' => $request->quantity,
            ]);

            return response()->json($food, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $food = Food::findOrFail($id);
            $food->delete();
            return response()->json('Food deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
