<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectCommentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'comment' => 'required|max:1000'
        ]);

        $project->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);
        return back();
    }
}
