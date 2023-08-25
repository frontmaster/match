<?php

namespace App\Http\Controllers;

use App\ApplyProject;
use App\DirectMessage;
use Illuminate\Http\Request;

class ApplyProjectsController extends Controller
{
    //応募案件詳細画面表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/');
        }
        $applyProject = ApplyProject::with('category')->find($id);
        $applyUserImg = $applyProject->applyUser->user_img;
        $applyUserName = $applyProject->applyUser->name;
        $applyProjectID = $id;
        $postProjectID = $applyProject->postProject->id;
        $user_id = auth()->user()->id;
        $directMessages = DirectMessage::all();
    
        return view('pages.applyProjectDetail', compact('applyProject', 'applyUserImg', 'applyUserName', 'applyProjectID', 'directMessages', 'user_id', 'postProjectID'));
    }

    //ダイレクトメッセージ送信
    public function send(Request $request, $id)
    {
        $request->validate([
            'msg' => 'required|string|max:5000'
        ]);
        
        $applyProject = ApplyProject::find($id);
        $user_id = auth()->user()->id;

        $directMsg = new DirectMessage;
        $directMsg->msg = $request->msg;
        $directMsg->sender_id = $user_id;
        $directMsg->post_user_id = $applyProject->postUser->id;
        $directMsg->apply_user_id = $applyProject->applyUser->id;
        $directMsg->project_id = $applyProject->project_id;
        $directMsg->save();

        return redirect('applyProjectDetail/' . $id)->with('flash_message', 'メッセージを送信しました');
    }
}
