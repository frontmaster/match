<?php

namespace App\Http\Controllers\Ajax;

use App\PostProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectListsController extends Controller
{
    public function index()
    {
        $projectLists = PostProject::with('category')->paginate(6);

        return $projectLists;
    }
}
