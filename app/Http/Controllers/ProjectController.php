<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'launch_date' => 'required|date',
            'company_name' => 'required|string',
            'video' => 'nullable|file|max:750000',
            'content' => 'required|string',
        ]);

        $project = Project::create($request->all());

        return response()->json($project, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return response()->json($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(null, 204);
    }
}
