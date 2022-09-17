<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostProjectListsController extends Controller
{
    public function index($id)
    {
        $postProjects = Auth::User()->PostProjects()->first();
        //自分が投稿した案件以外は表示できないようにする
        if ($id == auth()->user()->id) {
            return view('pages.postProjectList', compact('postProjects'));
        } else {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
    }
}
