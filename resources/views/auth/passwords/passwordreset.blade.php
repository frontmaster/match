@extends('layouts.master')

@section('title', 'パスワード再発行通知')

@include('read.head')

@section('content')
<main class="l-main">
    <div class="p-passReset">
        <div class="p-passReset__content">
            <p class="p-passReset__sentence">あなたのアカウントでパスワード再設定のリクエストがありました<br>
                以下のリンクをクリックし、パスワードリセットの手続きを行ってください。<br>
                このパスワードは60分後にリンク切れとなります<br>
                内容にお心当たりがない場合は、このメールは破棄して頂けるようお願いいたします。
            </p>
            <div class="p-passReset__button">
                <a href="{{ $reset_url }}" class="c-btn p-passReset__btn">パスワードをリセットする</a>
            </div>
        </div>
    </div>
</main>
@endsection