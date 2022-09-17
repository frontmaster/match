<?php

namespace App\Http\Controllers;

use App\User;
use App\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InformationNotification;

class InformationController extends Controller
{
    public function store(Request $request)
    {
        $information = Information::create([
            'date' => $request->get('date'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
        ]);

        $user = User::all();
        Notification::send($user, new InformationNotification($information));
    }
}
