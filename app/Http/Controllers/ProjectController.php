<?php

namespace App\Http\Controllers;


use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/projects",
     *     tags={"projects"},
     *     summary="Get list of projects",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
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
     * @OA\Post(
     *     path="/api/projects",
     *     tags={"projects"},
     *     summary="Create a new project",
     *     description="Create a new project with the provided data",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "subtitle", "launch_date", "company_name", "content"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="subtitle", type="string"),
     *             @OA\Property(property="launch_date", type="string", format="date"),
     *             @OA\Property(property="company_name", type="string"),
     *             @OA\Property(property="video", type="string", format="uri"),
     *             @OA\Property(property="content", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Project created successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input data"
     *     )
     * )
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
     * @OA\Get(
     *     path="/api/projects/{id}",
     *     tags={"projects"},
     *     summary="Get a project by ID",
     *     description="Fetch a single project by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the project to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Project not found"
     *     )
     * )
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
     * @OA\Put(
     *     path="/api/projects/{id}",
     *     tags={"projects"},
     *     summary="Update an existing project",
     *     description="Update a project with the provided data",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the project to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "subtitle", "launch_date", "company_name", "content"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="subtitle", type="string"),
     *             @OA\Property(property="launch_date", type="string", format="date"),
     *             @OA\Property(property="company_name", type="string"),
     *             @OA\Property(property="video", type="string", format="uri"),
     *             @OA\Property(property="content", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Project updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Project not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return response()->json($project);
    }

    /**
     * @OA\Delete(
     *     path="/api/projects/{id}",
     *     tags={"projects"},
     *     summary="Delete a project",
     *     description="Delete a project by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the project to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Project deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Project not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(null, 204);
    }
}
