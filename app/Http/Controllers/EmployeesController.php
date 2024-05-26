<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    // INDEX
    public function index()
    {
        $employees = Employees::all();
        return response()->json($employees, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $employee = Employees::findOrFail($id);
            return response()->json($employee);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    // STORE
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string',
                'jmbg' => 'required|string|size:13|unique:employees',
                'date_of_birth' => 'required|date|before:today',
                'employment_date' => 'required|date|before:today',
                'position_id' => 'required|exists:positions,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $employee = Employees::create([
                'full_name' => $request->full_name,
                'jmbg' => $request->jmbg,
                'date_of_birth' => $request->date_of_birth,
                'employment_date' => $request->employment_date,
                'position_id' => $request->position_id,
            ]);

            return response()->json($employee, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string',
                'jmbg' => 'required|string|size:13|unique:employees,jmbg,' . $id,
                'date_of_birth' => 'required|date|before:today',
                'employment_date' => 'required|date|before:today',
                'position_id' => 'required|exists:positions,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $employee = Employees::findOrFail($id);
            $employee->update([
                'full_name' => $request->full_name,
                'jmbg' => $request->jmbg,
                'date_of_birth' => $request->date_of_birth,
                'employment_date' => $request->employment_date,
                'position_id' => $request->position_id,
            ]);

            return response()->json($employee, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $employee = Employees::findOrFail($id);
            $employee->delete();
            return response()->json('Employee deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
