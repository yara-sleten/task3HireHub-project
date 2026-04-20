<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function getAll($request)
    {
        return Project::with([
                'client:id,name',
                'tags:id,name'
            ])
            ->withCount('offers')
            ->withAvg('reviews', 'rating')
            ->open()
            ->when($request->budget, fn($q) => $q->budgetAbove($request->budget))
            ->when($request->this_month, fn($q) => $q->thisMonth())
            ->latest()
            ->paginate(10);
    }

    public function getById($id)
    {
        return Project::with([
                'client:id,name',
                'tags:id,name',
                'offers.freelancer:id,name',
                'attachments',
                'reviews.client'
            ])
            ->withCount('offers')
            ->withAvg('reviews', 'rating')
            ->findOrFail($id);

    }
public function isClosed($project): bool
    {
        return $project->status === 'closed';
    }    

    public function create($data)
{
    $user = auth()->user();

    if (!$user || $user->role !== 'client') {
        return response()->json([
            'message' => 'Only clients can create projects'
        ], 403);
    }

    $data['client_id'] = $user->id;

    $project = Project::create($data);

    if (isset($data['tags'])) {
        $project->tags()->sync($data['tags']);
    }

    return $project;
}

    public function update($project, $data)
{
    $user = auth()->user();

    if ($project->client_id !== $user->id) {
        return response()->json([
            'message' => 'You are not allowed to update this project'
        ], 403);
    }

    $project->update($data);

    if (isset($data['tags'])) {
        $project->tags()->sync($data['tags']);
    }

    return $project;
}
   public function delete($project)
{
    $user = auth()->user();

    if ($project->client_id !== $user->id) {
        return response()->json([
            'message' => 'You are not allowed to delete this project'
        ], 403);
    }

    $project->delete();
}
}