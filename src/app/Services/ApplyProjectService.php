<?php

namespace App\Services;

use App\Models\ApplyProject;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ApplyProjectService
{
    
    public function applyProject($project)
    {
        $project = Project::where('id', $project->id)->first();
        $applyProject = new ApplyProject();
        $applyProject->project_title = $project->project_title;
        $applyProject->project_type = $project->project_type;
        $applyProject->price_min = $project->price_min;
        $applyProject->price_max = $project->price_max;
        $applyProject->content = $project->content;
        $applyProject->user_id = $project->user_id;
        $applyProject->apply_user_id = Auth::id();
        $applyProject->project_id = $project->id;
        $applyProject->save();
    }
}
