<?php

namespace App\Models;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'project_id',
        'file_name',
        'file_path',
        'file_type',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
