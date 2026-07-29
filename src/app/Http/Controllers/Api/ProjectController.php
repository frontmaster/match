<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ApplyProject;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // 全案件
    public function index(Request $request)
    {
        $projects = Project::latest()->get();
        return response()->json($projects);
    }

    // 自分の登録した案件
    public function myProjects()
    {
        return response()->json(
            Project::where('user_id', Auth::id())->latest()->get()
        );
    }

    // 自分の応募した案件
    public function myApplyProjects()
    {
        return response()->json(
            ApplyProject::where('apply_user_id', Auth::id())->latest()->get()
        );
    }
}
