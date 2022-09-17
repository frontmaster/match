<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function delete()
    {
        User::find(Auth::id())->delete();
        return redirect('/')->with('flash_message', '退会手続きが完了しました');    
    }

    public function delete_confirm()
    {
        return view('pages.users_delete_confirm');
    }
}
