<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    // INDEX
    public function index()
    {
        $tickets = Tickets::all();
        return response()->json($tickets, 200);
    }

    // SHOW
    public function show($id)
    {
        try {
            $ticket = Tickets::findOrFail($id);
            return response()->json($ticket);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    // STORE
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'price' => 'required|numeric|min:0',
                'sale_date' => 'required|date|before_or_equal:today',
                'employee_id' => 'required|exists:employees,id',
                'visit_date' => 'required|date|after_or_equal:today',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $ticket = Tickets::create([
                'price' => $request->price,
                'sale_date' => $request->sale_date,
                'employee_id' => $request->employee_id,
                'visit_date' => $request->visit_date,
            ]);

            return response()->json($ticket, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'price' => 'required|numeric|min:0',
                'sale_date' => 'required|date|before_or_equal:today',
                'employee_id' => 'required|exists:employees,id',
                'visit_date' => 'required|date|after_or_equal:today',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $ticket = Tickets::findOrFail($id);
            $ticket->update([
                'price' => $request->price,
                'sale_date' => $request->sale_date,
                'employee_id' => $request->employee_id,
                'visit_date' => $request->visit_date,
            ]);

            return response()->json($ticket, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    // DELETE
    public function destroy($id)
    {
        try {
            $ticket = Tickets::findOrFail($id);
            $ticket->delete();
            return response()->json('Ticket deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
