<?php

namespace App\Http\Controllers;

use App\Models\Intake;
use Illuminate\Support\Facades\Validator;

class IntakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->is('api/*')) {
            return response()->json(["intakes" => Intake::all()], 200);
        } else {
            $intakes = Intake::all();
            return view('intake.index', compact('intakes'));
        }
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
        // dd(request()->all());
        // try {
        $validate = Validator::make(request()->all(), [
            'name' => 'required|string',
            'start_month' => 'required|string',
            'end_month' => 'required|string',
            'year' => 'required|string|max:4',
        ]);
        // return $valid->errors();
        if ($validate->fails()) {
            if (request()->is('api/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        if (!Intake::where([['name', request('name')], ['year', request('year')]])->exists()) {
            Intake::create([
                'name' => request('name'),
                'start_month' => request('start_month'),
                'end_month' => request('end_month'),
                'year' => request('year'),
                'student_capacity' => request('student_capacity') ?? 50,
                'status' => request('status') ?? 'active',
            ]);
            if (request()->is('api/*')) {
                return response()->json(['message' => 'Intake created successfully'], 200);
            }
            return redirect()->back()->with('success', 'Intake created successfully');
        }else{
            if (request()->is('api/*')) {
                return response()->json(['message' => 'Intake with the same name and year already exists'], 409);
            }
            return redirect()->back()->withErrors('Intake with the same name and year already exists')->withInput();
        }
        // } catch (\Throwable $th) {
        //     if (request()->is('api/*')) {
        //         return response()->json(['message' => 'Something went wrong. ' . $th->getMessage()], 500);
        //     }
        //     return redirect()->back()->with('error', 'Something went wrong. ' . $th->getMessage());
        // }
    }
    public function getIntakeByStatus($status)
    {
        if (request()->is('api/*')) {
            return response()->json(["intakes" => Intake::where('status', $status)->get()], 200);
        } else {
            $intakes = Intake::where('status', $status)->get();
            return view('intake.index', compact('intakes'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $intake = Intake::findOrFail($id);
        if (request()->is('api/*')) {
            return response()->json(["intake" => $intake], 200);
        }
        return view('intake.show', compact('intake'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $intake = Intake::findOrFail($id);
        if (request('name') != null) {
            $intake->name = request('name');
        }
        if (request('start_month') != null) {
            $intake->start_month = request('start_month');
        }
        if (request('end_month') != null) {
            $intake->end_month = request('end_month');
        }
        if (request('year') != null) {
            $intake->year = request('year');
        }
        if (request('student_capacity') != null) {
            $intake->student_capacity = request('student_capacity');
        }
        if (request('status') != null) {
            $intake->status = request('status');
        }
        if (request('progress') != null) {
            $intake->progress = request('progress');
        }
        $intake->update();
        if (request()->is('api/*')) {
            return response()->json(['message' => 'Intake updated successfully'], 200);
        }
        return redirect()->back()->with('success', 'Intake updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Intake::destroy($id);
        if (request()->is('api/*')) {
            return response()->json(['message' => 'Intake deleted successfully'], 200);
        }
        return redirect()->back()->with('success', 'Intake deleted successfully');
    }
}
