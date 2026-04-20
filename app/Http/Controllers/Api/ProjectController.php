<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;

        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $projects = $this->service->getAll($request);

        return ProjectResource::collection($projects);
    }

    public function show($id)
    {
        $project = $this->service->getById($id);

        return new ProjectResource($project);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = $this->service->create($request->validated());

        return response()->json([
            'success' => true,
            'data' => new ProjectResource($project),
            'message' => 'Project created successfully'
        ], 201);
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project = $this->service->update($project, $request->validated());

        return response()->json([
            'success' => true,
            'data' => new ProjectResource($project),
            'message' => 'Project updated successfully'
        ]);
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $this->service->delete($project);

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}