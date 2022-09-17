<?php

namespace App\Http\Controllers;

use App\ApplyProject;
use App\PostProject;
use App\PublicMessage;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function send(Request $request, $id)
    {
        $request->validate([
            'msg' => 'required|string|max:5000'
        ]);

        $postProjects = PostProject::find($id);
        $user_id = auth()->user()->id;

        $publicMsg = new PublicMessage;
        $publicMsg->msg = $request->msg;
        $publicMsg->sender_id = $user_id;
        $publicMsg->post_user_id = $postProjects->user->id;
        $publicMsg->project_id = $id;
        $publicMsg->save();

        return redirect('projectDetail/' . $id)->with('flash_message', 'メッセージを送信しました');

    }
}
