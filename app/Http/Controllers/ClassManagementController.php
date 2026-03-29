<?php

namespace App\Http\Controllers;

use App\Models\ClassManagement;
use Illuminate\Support\Facades\Auth;

class ClassManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassManagement::with('program', 'user')->get();
        return response()->json(['classes' => $classes]);
    }

    public function upcomingClasses()
    {
        $classes = ClassManagement::with('program', 'user')
            ->where('date_time', '>', now())
            ->get();
        return response()->json(['upcoming_classes' => $classes]);
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
        $validated = request()->validate([
            'title' => 'required|string|max:255',
            'program_id' => 'required|exists:courses,id',
            'description' => 'nullable|string',
            'date_time' => 'required|string',
            'address' => 'required|string',
            'status' => 'nullable|string|in:scheduled,completed,cancelled',
        ]);
        $validated['created_by'] = Auth::id();
        $class = ClassManagement::create($validated);
        return response()->json(['class' => $class]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $class = ClassManagement::with('program', 'user')->findOrFail($id);
        return response()->json(['class' => $class]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassManagement $classManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        try {
            $class = ClassManagement::findOrFail($id);
            $validated = request()->validate([
                'title' => 'nullable|string|max:255',
                'program_id' => 'nullable|exists:courses,id',
                'description' => 'nullable|string',
                'date_time' => 'nullable|string',
                'address' => 'nullable|string',
                'status' => 'nullable|string|in:scheduled,completed,cancelled',
            ]);
            if(!$validated){
                return response()->json(['message' => 'No valid fields provided for update'], 400);
            }
            if (request('title') != null) {
                $class->title = request('title');
            }
            if (request('program_id') != null) {
                $class->program_id = request('program_id');
            }
            if (request('description') != null) {
                $class->description = request('description');
            }
            if (request('date_time') != null) {
                $class->date_time = request('date_time');
            }
            if (request('address') != null) {
                $class->address = request('address');
            }
            if (request('status') != null) {
                $class->status = request('status');
            }
            $class->update();
            return response()->json(['class' => $class, 'message' => 'Class updated successfully'], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ClassManagement::destroy($id);
        return response()->json(['message' => 'Class deleted successfully'], 200);
    }
}
