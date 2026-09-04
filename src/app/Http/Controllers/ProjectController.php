<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Services\ProjectService;
use App\Models\Project;
use App\Models\ApplyProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        $comments = $project->comments()->with('user')->latest()->get();
        $applyProject = ApplyProject::where('project_id', $project->id)->where('apply_user_id', Auth::id())->first();
        $postProject = Project::where('id', $project->id)->where('user_id', Auth::id())->first();
        return view('projects.show', compact('project', 'comments', 'applyProject', 'postProject'));
    }

    public function index()
    {
        
        return view('projects.index');
    }
}
