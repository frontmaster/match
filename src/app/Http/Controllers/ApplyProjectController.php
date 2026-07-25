<?php

namespace App\Http\Controllers;

use App\Services\ApplyProjectService;
use App\Models\Project;
use App\Models\ApplyProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApplyProjectController extends Controller
{
    protected $applyProjectService;

    public function __construct(ApplyProjectService $applyProjectService)
    {
        $this->applyProjectService = $applyProjectService;
    }

    public function store(Project $project)
    {
        $applyProject = ApplyProject::where('project_id', $project->id)->where('apply_user_id', Auth::id())->first();
        if ($applyProject) {

            return redirect()->route('projects.show', $project)->with('success', 'すでにその案件に応募済みです。');
        }
        $this->applyProjectService->applyProject($project);

        return redirect()->route('projects.show', $project)->with('success', '案件に応募しました');
    }
}
