<?php

namespace App\Http\Controllers;

use App\Like;
use App\User;
use App\Category;
use App\Information;
use App\PostProject;
use App\ApplyProject;
use App\PublicMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class PostProjectsController extends Controller
{
    //案件投稿画面表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        $categories = Category::get();
        return view('pages.post_project', compact('categories'));
    }

    //案件投稿
    public function create(Request $request)
    {
        //単発を選んだ場合の登録
        if ($request->category == 1) {
            $request->validate([
                'title' => 'required|string|max:20',
                'category' => 'required|',
                'low_price' => 'required|numeric|min:1|digits_between:1,4',
                'high_price' => 'required|numeric|min:1|digits_between:1,4',
                'content' => 'required|string|max:5000',

            ]);
            $postProject = new PostProject;
            $postProject->title = $request->title;
            $postProject->low_price = $request->low_price;
            $postProject->high_price = $request->high_price;
            $postProject->content = $request->content;
            $postProject->post_user_id = auth()->id();
            $postProject->category_id = $request->category;
            $postProject->save();

            return redirect('post_project/' . auth()->user()->id)->with('flash_message', '案件を投稿しました');
            //レベニューシェアを選んだ場合、単発の金額にはバリデーションをかけず、DBにも登録しない。
        } else if ($request->category == 2) {
            $request->validate([
                'title' => 'required|string|max:20',
                'category' => 'required|',
                'content' => 'required|string|max:5000',

            ]);
            $postProject = new PostProject;
            $postProject->title = $request->title;
            $postProject->content = $request->content;
            $postProject->post_user_id = auth()->id();
            $postProject->category_id = $request->category;
            $postProject->save();

            return redirect('post_project/' . auth()->user()->id)->with('flash_message', '案件を投稿しました');
            //一切入力しないで送信した時は全の項目にバリデーションをかける
        } else {
            $request->validate([
                'title' => 'required|string|max:20',
                'category' => 'required|',
                'low-price' => 'required|numeric|min:1|digits_between:1,4',
                'high-price' => 'required|numeric|min:1|digits_between:1,4',
                'content' => 'required|string|max:5000',

            ]);
            $postProject = new PostProject;
            $postProject->title = $request->title;
            $postProject->low_price = $request->low_price;
            $postProject->high_price = $request->high_price;
            $postProject->content = $request->content;
            $postProject->post_user_id = auth()->id();
            $postProject->category_id = $request->category;
            $postProject->save();

            return redirect('post_project/' . auth()->user()->id)->with('flash_message', '案件を投稿しました');
        }
    }

    //案件詳細画面表示
    public function detail($id)
    {
        if (!ctype_digit($id)) {
            return redirect('projectList')->with('flash_message', '不正な操作が行われました');
        }

        $user_id = auth()->user()->id;
        $project_id = $id;
        $postProjects = PostProject::withTrashed()->find($id);
        $applyProjects = ApplyProject::where('project_id', $id)->where('apply_user_id', $user_id)->first();
        $publicMsgs = PublicMessage::with('sender', 'project')->get();
        $publicMsg = PublicMessage::where('project_id', $id)->first();
        $already_liked = Like::where('user_id', $user_id)->where('project_id', $id)->first();
        $likes = Like::where('project_id', $id)->get();
        //dd($likes);

        if ($postProjects) {
            $postUser = $postProjects->user();
            $postUserImg = optional($postProjects->user)->user_img;
            $postUserName = optional($postProjects->user)->name;
            $category = $postProjects->category()->first();
            $postUserID = $postUser->first();
            $postProjectID = $id;

            return view('pages.projectDetail', compact(
                'postProjects',
                'category',
                'applyProjects',
                'postUser',
                'postUserID',
                'postProjectID',
                'publicMsgs',
                'postUserImg',
                'postUserName',
                'project_id',
                'publicMsg',
                'user_id',
                'already_liked',
                'likes'
            ));
        } else {
            return redirect('mypage/' . $user_id)->with('flash_message', 'このIDの案件は存在しません');
        }
    }

    //「いいね」を登録・削除
    public function like(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $postProjects = PostProject::withTrashed()->find($id);
        $applyProjects = ApplyProject::where('project_id', $id)->where('apply_user_id', $user_id)->first();
        $publicMsgs = PublicMessage::with('sender', 'project')->get();
        $publicMsg = PublicMessage::where('project_id', $id)->first();
        $project_id = $id;
        $already_liked = Like::where('user_id', $user_id)->where('project_id', $project_id)->first();
        $postUser = $postProjects->user();
        $postUserImg = $postProjects->user->user_img;
        $postUserName = $postProjects->user->name;
        $category = $postProjects->category()->first();
        $postUserID = $postUser->first();
        $postProjectID = $id;
        $likes = Like::where('project_id', $id)->get();
        $postUser = $postProjects->user();
        //dd($likes);
        if (!$already_liked) {
            $like = new Like;
            $like->project_id = $project_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            Like::where('user_id', $user_id)->where('project_id', $project_id)->delete();
        }
        return view('pages.projectDetail', compact('postProjects', 'user_id', 'project_id', 'already_liked', 
        'postUserImg', 'postUserName', 'category', 'postUserID', 'postProjectID', 
        'applyProjects', 'publicMsg', 'likes', 'postUser', 'publicMsgs'));
    }

    //案件に応募
    public function apply($id)
    {
        $user_id = auth()->user()->id;
        $postProjects = PostProject::find($id);
        $postUser = $postProjects->user();
        $applyProject = ApplyProject::where('apply_user_id', $user_id)->where('project_id', $id)->first();
        $postUserID = PostProject::where('post_user_id', $user_id)->first();






        if (!ctype_digit($id)) {
            return redirect('projectDetail/' . $postProjects->id)->with('flash_message', '不正な操作が行われました');
        }


        if ($postProjects && $user_id != $postProjects->post_user_id && $user_id != optional($applyProject)->apply_user_id) {
            $applyProjects = new ApplyProject;
            $applyProjects->title = $postProjects->title;
            $applyProjects->low_price = $postProjects->low_price;
            $applyProjects->high_price = $postProjects->high_price;
            $applyProjects->content = $postProjects->content;
            $applyProjects->post_user_id = $postProjects->post_user_id;
            $applyProjects->apply_user_id = $user_id;
            $applyProjects->category_id = $postProjects->category_id;
            $applyProjects->project_id = $postProjects->id;
            $applyProjects->save();



            return redirect('mypage' . '/' . auth()->user()->id)->with('flash_message', '案件に応募しました');
        } else if (optional($applyProject)->apply_user_id == $user_id) {
            return redirect('projectDetail/' . $id)->with('flash_message', 'すでに応募しています');
        } else if (optional($postUserID)->post_user_id == $user_id) {
            return redirect('projectDetail/' . $id)->with('flash_message', '案件投稿者は応募できません');
        } else if ($postUser->deleted_at != null) {
            return redirect('projectDetail/' . $id)->with('flash_message', '案件投稿者が退会しているため応募できません');
        }
    }

    //案件編集画面表示
    public function edit($id)
    {
        $postProjects = PostProject::find($id);
        $categories = Category::get();
        $applyProject = ApplyProject::where('project_id', $id)->first();


        if (!ctype_digit($id)) {
            return redirect('post_projectList/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        //ログインユーザーIDと案件投稿者のIDが一致した場合のみ編集が面表示
        if (optional($postProjects)->post_user_id == auth()->user()->id) {
            return view('pages.post_project_edit', compact('postProjects', 'categories', 'applyProject'));
        } else {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
    }

    //編集した案件の更新
    public function update(Request $request, $id)
    {
        $postProjects = PostProject::find($id);
        $user_id = auth()->user()->id;
        $applyProject = ApplyProject::where('project_id', $id)->first();
        if (!ctype_digit($id)) {
            return redirect('post_project_edit/' . $id)->with('flash_message', '不正な操作が行われました');
        }

        //ログインユーザーIDと案件投稿者のIDが一致かつ単発を選んだ際の処理
        if ($postProjects->post_user_id == $user_id && $request->category == 1 && $applyProject == null) {
            $request->validate([
                'title' => 'required|string|max:20',
                'category' => 'required',
                'low_price' => 'required|numeric|min:1|digits_between:1,4',
                'high_price' => 'required|numeric|min:1|digits_between:1,4',
                'content' => 'required|string|max:5000'
            ]);

            $postProjects->title = $request->title;
            $postProjects->low_price = $request->low_price;
            $postProjects->high_price = $request->high_price;
            $postProjects->content = $request->content;
            $postProjects->post_user_id = $user_id;
            $postProjects->category_id = $request->category;
            $postProjects->save();
            return redirect('post_projectList/' . $user_id)->with('flash_message', '案件を編集しました');
            //レベニューシェアを選んだ際の処理
        } else if ($postProjects->post_user_id == $user_id && $request->category == 2 && $applyProject == null) {
            $request->validate([
                'title' => 'required|string|max:20',
                'category' => 'required',
                'content' => 'required|string|max:5000'
            ]);

            $postProjects->title = $request->title;
            $postProjects->content = $request->category;
            $postProjects->post_user_id = $user_id;
            $postProjects->category_id = $request->category;
            $postProjects->low_price = $request->low_price;
            $postProjects->high_price = $request->high_price;
            $postProjects->save();
            return redirect('post_projectList/' . $user_id)->with('flash_message', '案件を編集しました');
        } else if ($postProjects->post_user_id == $user_id && $request->category == 2 or $request->category == 1 && $applyProject) {
            return redirect('post_projectList/' . $user_id)->with('flash_message', 'すでに応募者がいるため編集できません');
        } else {
            return redirect('post_projectList/' . $user_id)->with('flash_message', '不正な操作がありました');
        }
    }

    //案件削除
    public function delete($id)
    {
        if (!ctype_digit($id)) {
            return redirect('post_project_edit/' . $id)->with('flash_message', '不正な操作が行われました');
        }

        $user_id = auth()->user()->id;
        PostProject::find($id)->delete();

        return redirect('post_projectList/' . $user_id)->with('flash_message', '案件を削除しました');
    }
}
