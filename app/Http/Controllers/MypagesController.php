<?php

namespace App\Http\Controllers;

use App\ApplyProject;
use App\DirectMessage;
use App\PostProject;
use App\PublicMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypagesController extends Controller
{
    //マイページ表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/');
        }
        $user = Auth::User();
        
        $postProjects = $user->PostProjects()->with('category')->orderBy('created_at', 'DESC')->take(6)->get();
        //自分が応募した案件
        $applyProjects = $user->ApplyProjects()->with('category')->orderBy('created_at', 'DESC')->take(6)->get();
        //自分が登録した案件に応募してきたデータを取得
        $applyProject = ApplyProject::with('category')->where('post_user_id', auth()->user()->id)->orWhere('apply_user_id', auth()->user()->id)->first();
        $projectID = optional($applyProject)->project_id;
        $publicMessages = PublicMessage::with('project')->where('sender_id', auth()->user()->id)->latest('created_at')->take(1)->first();
        $directMessages = DirectMessage::where('project_id', $projectID)->latest('created_at')->take(1)->first();
        $applyUserImg = optional($applyProject)->applyUser;
        $postUserImg = optional($applyProject)->postUser;
        $applyUserImg = optional($applyUserImg)->user_img;
        $postUserImg = optional($postUserImg)->user_img;
        //dd($applyProjects);
        return view('pages.mypage', compact('postProjects', 'applyProjects', 'publicMessages', 'applyProject', 'directMessages', 'user', 'applyUserImg', 'postUserImg'));
    }
}
