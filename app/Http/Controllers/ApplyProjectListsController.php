<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyProjectListsController extends Controller
{
    public function index($id)
    {
        $applyProject = Auth::User()->ApplyProjects()->first();

        if ($id == auth()->user()->id) {

            return view('pages.applyProjectList', compact('applyProject'));
        } else {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
    }
}
