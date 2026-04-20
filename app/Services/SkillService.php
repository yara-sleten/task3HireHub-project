<?php
namespace App\Services;

use App\Models\Skill;

class SkillService
{
    public function getAll()
    {
        return Skill::with('freelancerProfiles:id,user_id')->get();
    }

    public function getById($id)
    {
        return Skill::with('freelancerProfiles.user:id,name')
            ->findOrFail($id);
    }

    public function create($data)
    {
        return Skill::create($data);
    }

    public function update($skill, $data)
    {
        $skill->update($data);
        return $skill;
    }

    public function delete($skill)
    {
        return $skill->delete();
    }

    public function attachToFreelancer($skill, $freelancerProfileId, $years)
    {
        $skill->freelancerProfiles()->attach($freelancerProfileId, [
            'years_of_experience' => $years
        ]);
    }

    public function detachFromFreelancer($skill, $freelancerProfileId)
    {
        $skill->freelancerProfiles()->detach($freelancerProfileId);
    }
}