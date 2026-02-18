<?php

namespace App\Http\Controllers;

use App\Models\FeePayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = FeePayment::all();
        if (request()->is('api/*')) {
            return response()->json($payments);
        }
        return view('feePayment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        try {
            $validate = Validator::make(request()->all(),[
                'student_id'=>'required|exists:users,id',
                'amount'=>'required|numeric|min:0',
                'payment_method'=>'required|string',
                'payment_status'=>'required|string',
                'logged_by'=>'required|exists:users,id'
            ]);
            if($validate->fails()){
                return response()->json($validate->errors(),400);
            }
            FeePayment::create([
                'student_id'=>request('student_id'),
                'fee_id'=>request('fee_id'),
                'amount'=>request('amount'),
                'payment_method'=>request('payment_method'),
                'payment_status'=>request('payment_status'),
                'logged_by'=>Auth::id()
            ]);
            if (request()->is('api/*')) {
                return response()->json([
                    'message' => 'Fee Payment created successfully',
                    'data' => FeePayment::latest()->first()
                ], 201);
            }
            return redirect()->back()->with('success', 'Fee Payment created successfully');
        } catch (\Throwable $th) {
            if (request()->is('api/*')) {
                return response()->json([
                    'message' => 'An error occurred while creating the fee payment',
                    'error' => $th->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'An error occurred while creating the fee payment');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $feePayment = FeePayment::find($id);
        if (!$feePayment) {
            if (request()->is('api/*')) {
                return response()->json([
                    'message' => 'Fee Payment record not found',
                ], 404);
            }
            return redirect()->back()->with('error', 'Fee Payment record not found');
        }
        if (request()->is('api/*')) {
            return response()->json($feePayment);
        }
        return view('feePayment.show', compact('feePayment'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeePayment $feePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        try {
            $feePayment = FeePayment::findOrFail($id);
            $feePayment->update(request()->all());
            if (request()->is('api/*')) {
                return response()->json([
                    'message' => 'Fee Payment record updated successfully',
                    'data' => $feePayment
                ], 200);
            }
            return redirect()->back()->with('success', 'Fee Payment record updated successfully');
        } catch (\Throwable $th) {
            if (request()->is('api/*')) {
                return response()->json(['message' => 'Error updating fee payment', 'error' => $th->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Error updating fee payment');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeePayment $feePayment)
    {
        try {
            $feePayment->delete();
            if (request()->is('api/*')) {
                return response()->json(['message' => 'Fee Payment deleted successfully'], 200);
            }
            return redirect()->back()->with('success', 'Fee Payment deleted successfully');
        } catch (\Throwable $th) {
            if (request()->is('api/*')) {
                return response()->json(['message' => 'Error deleting fee payment', 'error' => $th->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Error deleting fee payment');
        }
    }
}
