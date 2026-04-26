<?php

namespace App\Models;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
       'project_id', 'client_id','freelancer_id','rating','comment','freelancer_profile_id'
    ];

    public function client()
    {
        return $this->belongsTo(User::class,'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class,'freelancer_id');
    }
    public function project()
{
    return $this->belongsTo(Project::class);
}
public function freelancerProfile()
{
    return $this->belongsTo(FreelancerProfile::class, 'freelancer_profile_id');
}
}
