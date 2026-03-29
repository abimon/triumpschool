<?php

namespace App\Http\Controllers;

use App\Models\ResourceManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResourceManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = ResourceManagement::all();
        return response()->json(['resources' => $resources]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function myclasses()
    {
        $userId = Auth::id();
        $classes = ResourceManagement::where('created_by', $userId)->get();
        return response()->json(['my_classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'program_id' => 'required|exists:courses,id',
            'file' => 'required|file|max:10240', // max 10MB
        ]);
        if (!$val) {
            return response()->json(['message' => 'Validation failed', 'errors' => $val->errors()], 422);
        }
        $path = request()->file('file')->store('resources');
        $validated['title'] = request('title');
        $validated['description'] = request('description');
        $validated['program_id'] = request('program_id');
        $validated['path'] = $path;
        $validated['size'] = $request->file('file')->getSize();
        $validated['mime_type'] = $request->file('file')->getMimeType();
        $validated['uploaded_by'] = Auth::id();
        $resource = ResourceManagement::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'program_id' => $validated['program_id'],
            'path' => $validated['path'],
            'size' => $validated['size'],
            'mime_type' => $validated['mime_type'],
            'uploaded_by' => $validated['uploaded_by'],
        ]);
        return response()->json(['resource' => $resource]);
    }
    public function show($id)
    {
        $resource = ResourceManagement::findOrFail($id);
        return response()->json(['resource' => $resource,'message' => 'Resource details retrieved successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResourceManagement $resourceManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $resource = ResourceManagement::findOrFail($id);
        if(request()->hasFile('file')){
            $path = request()->file('file')->store('resources');
            $resource->path = $path;
            $resource->size = request()->file('file')->getSize();
            $resource->mime_type = request()->file('file')->getMimeType();
        }
        if(request('title')!=null){
            $resource->title = request('title');
        }
        if(request('description')!=null){
            $resource->description = request('description');
        }
        if(request('program_id')!=null){
            $resource->program_id = request('program_id');
        }
        $resource->uploaded_by = Auth::id();
        $resource->update();
        return response()->json(['resource' => $resource,'message' => 'Resource updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ResourceManagement::destroy($id);
        return response()->json(['message' => 'Resource deleted successfully'], 200);
    }
}
