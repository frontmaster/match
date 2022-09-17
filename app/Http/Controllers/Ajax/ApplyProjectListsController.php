<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApplyProjectListsController extends Controller
{
    public function index()
    {
        $applyProjectLists = Auth::user()->ApplyProjects()->with('category')->paginate(6);

        return $applyProjectLists;
    }
}
