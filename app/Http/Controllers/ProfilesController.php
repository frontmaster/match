<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    //プロフィール編集画面表示
    public function edit($id)
    {
        if(!ctype_digit($id)){
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    }

    //プロフィール更新
    public function update(Request $request, $id)
    {
        if(!ctype_digit($id)){
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|string|max:255',
            'user_img' =>'max:1024|mimes:jpg,jpeg,png,gif',
            'comment' => 'max:10000',
        ]);

        $user = User::find($id);

        if($request and $request->user_img != null){
            $img_url = $request->user_img->store('public/image');
            $user->name = $request->name;
            $user->email = $request->email;
            $user->user_img = str_replace('public/', 'storage/', $img_url);
            $user->comment = $request->comment;
            $user->save();
            return redirect('/profile' . '/' .  $user->id)->with('flash_message', 'プロフィールを編集しました');
        }else if($request and $request->user_img == null){
            $user->fill($request->all())->save();
            return redirect('/profile' . '/' . $user->id)->with('flash_message', 'プロフィールを編集しました');
        }


    }
}
