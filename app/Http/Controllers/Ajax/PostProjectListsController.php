<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostProjectListsController extends Controller
{
    public function index()
    {
        $postProjectLists = Auth::user()->PostProjects()->with('category', 'user')->paginate(6);
        
        return $postProjectLists;
    }
}
