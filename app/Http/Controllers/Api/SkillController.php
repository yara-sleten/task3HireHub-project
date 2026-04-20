<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Services\SkillService;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Requests\AttachSkillRequest;
use App\Http\Requests\DetachSkillRequest;

class SkillController extends Controller
{
    public function __construct(
        private SkillService $service
    ) {}

    public function index()
    {
        return response()->json(
            $this->service->getAll()
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->service->getById($id)
        );
    }

    public function store(StoreSkillRequest $request)
    {
        return response()->json(
            $this->service->create($request->validated()),
            201
        );
    }

    public function update(UpdateSkillRequest $request, $id)
    {
        $skill = Skill::findOrFail($id);

        return response()->json(
            $this->service->update($skill, $request->validated())
        );
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);

        $this->service->delete($skill);

        return response()->json([
            'message' => 'Skill deleted successfully'
        ]);
    }

    public function attachToFreelancer(AttachSkillRequest $request, $skillId)
    {
        $skill = Skill::findOrFail($skillId);

        $this->service->attachToFreelancer(
            $skill,
            $request->freelancer_profile_id,
            $request->years_of_experience
        );

        return response()->json([
            'message' => 'Skill attached successfully'
        ]);
    }

    public function detachFromFreelancer(DetachSkillRequest $request, $skillId)
    {
        $skill = Skill::findOrFail($skillId);

        $this->service->detachFromFreelancer(
            $skill,
            $request->freelancer_profile_id
        );

        return response()->json([
            'message' => 'Skill detached successfully'
        ]);
    }
}