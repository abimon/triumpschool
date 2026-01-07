<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::join('users', 'users.id', '=', 'students.user_id')->join('intakes', 'intakes.id', '=', 'students.intake_id')
            ->select('students.*', 'users.name', 'users.image', 'intakes.name as intake_name')
            ->get();
        if(request()->is('api/*')) {
            return response()->json($students, 200);
        }
        return view('student.index', compact('students'));
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
            $validate = Validator::make(request()->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'intake_id' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }
            $user = User::where('email', request()->email)->first();
            if (!$user) {
                $user = User::create([
                    'name' => request('name'),
                    'email' => request('email'),
                    'password' => Hash::make(request('')),
                    'phone' => request('phone'),
                    'role' => 'Student',
                ]);
            }

            Student::create([
                'user_id' => $user->id,
                'intake_id' => request('intake_id'),
                "course" => request('course'),
                "mode_of_contact" => request('mode_of_contact'),
            ]);
            if (request()->hasFile('image')) {
                $user->update([
                    'image' => request()->file('image')->store('images', 'public')
                ]);
            }
            if (request()->is('api/*')) {
                return response()->json(['message' => 'Student created successfully'], 200);
            }
            return redirect()->back()->with('success', 'Student created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        try {
            $student = Student::findOrFail($id);
            if(request('course')!=null){
                $student->course=request('course');
            }
            if(request('mode_of_contact')!=null){
                $student->mode_of_contact=request('mode_of_contact');
            }
            if(request('status')!=null){
                $student->status=request('status');
            }
            $student->update();
            if (request()->is('api/*')) {
                return response()->json(['message' => 'Student updated successfully'], 200);
            }
            return redirect()->back()->with('success', 'Student updated successfully');
            
        } catch (\Throwable $th) {
            if(request()->is('api/*')) {
                return response()->json(['message' => $th->getMessage()], 500);
            }
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Student::destroy($id);
        if (request()->is('api/*')) {
            return response()->json(['message' => 'Student deleted successfully'], 200);
        }
        return redirect()->back()->with('success', 'Student deleted successfully');
    }
}
