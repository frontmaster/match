<?php

namespace App\Http\Controllers;

use App\PostProject;
use Illuminate\Http\Request;

class ProjectListsController extends Controller
{
    public function index()
    {
        $projectLists = PostProject::with('category')->get();
        return view('pages.projectList', compact('projectLists'));
    }
}
