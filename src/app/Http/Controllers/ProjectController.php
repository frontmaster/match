<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }


    // 案件登録画面表示
    public function create()
    {
        return view('projects.create');
    }

    public function store(ProjectRequest $request)
    {
        $this->projectService->createProject($request->validated());

        return redirect()->route('projects.create')->with('success', '案件を登録しました');
    }

    public function show(Project $project)
    {
        $comments = $project->comments()->latest()->get();
        return view('projects.show', compact('project', 'comments'));
    }
}
