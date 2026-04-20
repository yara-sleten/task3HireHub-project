<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

    protected $fillable = [
        'name'
    ];
        public function freelancerProfiles()
    {
        return $this->belongsToMany(
            FreelancerProfile::class,
            'freelancer_skill'
        )->withPivot('years_of_experience');
    }


}
