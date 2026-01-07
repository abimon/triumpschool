<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        if (request()->is('api/*')) {
            return response()->json($courses);
        }
        return view('courses.index', compact('courses'));
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
            $valid = Validator::make(request(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'price' => 'required|string',
                'cover' => 'nullable|image',
                'status' => 'nullable|string',
            ]);
            if ($valid->fails()) {
                return response()->json($valid->errors(), 400);
            }
            $course = Course::create([
                'title' => request('title'),
                'slug' => Str::slug(request('title'), '_'),
                'description' => request('description'),
                'price' => request('price'),
                'status' => request('status'),
            ]);
            if (request()->hasFile('cover')) {
                $course->cover = request()->file('cover')->store('courses', 'public');
                $course->save();
            }
            return response()->json($course, 201);
        } catch (\Throwable $th) {
            if (request()->is('api/*')) {
                return response()->json(['message' => $th->getMessage()], 500);
            } else {
                return redirect()->back()->with('error', $th->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        if (request()->is('api/*')) {
            return response()->json(['course'=>$course]);
        }
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $course = Course::findOrFail($id);
        if(request('title')!=null){
            $course->title=request('title');
            $course->slug=Str::slug(request('title'),'_');
        }
        if(request('description')!=null){
            $course->description=request('description');
        }
        if(request('price')!=null){
            $course->price=request('price');
        }
        if (request()->hasFile('cover')) {
            $course->cover = request()->file('cover')->store('courses', 'public');
            
        }
        if(request('status')!=null){
            $course->status=request('status');
        }
        $course->update();
        if (request()->is('api/*')) {
            return response()->json(['message'=>'Course updated successfully'], 200);
        }
        return redirect()->back()->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Course::destroy($id);
        if (request()->is('api/*')) {
            return response()->json(['message'=>'Course deleted successfully'], 200);
        }
        return redirect()->back()->with('success', 'Course deleted successfully');
    }
}
