@extends('layouts.master')

@section('title', 'match')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    @if(session('flash_message'))
    <div class="c-flashMsgContainer js-flashMsg">
        {{ session('flash_message') }}
    </div>
    @endif
    <div class="p-top">
        <div class="p-top__imgContainer">
            <div class="p-top__sentenceContainer">
                <p class="p-top__sentence">
                    もっと簡単に案件のやり取りをしませんか？</br>
                    matchでは手軽に案件投稿・応募ができます
                </p>
                <p class="p-top__sentence--small">
                    オプションや様々な入力項目はありません!</br>
                    案件のタイトル・種別・金額・内容を入力するだけでOK!
                </p>
                <p class="p-top__sentence--title">
                    エンジニアと企業を繋ぐマッチングサービス</br>
                    match
                </p>
                <a href="{{ route('register') }}" class="c-btn p-top__link">無料でユーザー登録する</a>
            </div>
            <img src="{{ asset('img/business-5.png') }}" class="p-top__img" alt="">
        </div>
        <div class="p-top__content">
            <h1 class="p-top__title">Features</h1>
            <p class="p-top__sentence--content">matchの特徴</p>
            <div class="p-top__panelContent">
                <section class="p-top__panel">
                    <div class="p-top__number">1</div>
                    <span class="p-top__border"></span>
                    <div class="p-top__imgContainer--panel">
                        <img src="{{ asset('img/login.webp') }}" class="p-top__img--panel" alt="">
                    </div>
                    <p class="p-top__sentence--panel">
                        メールアドレスとパスワードだけで</br>
                        簡単に登録!</br>
                        複雑な入力項目はありません</br>
                        すぐに登録できて</br>
                        すぐにサービスを受けられます
                    </p>
                </section>
                <section class="p-top__panel">
                    <div class="p-top__number">2</div>
                    <span class="p-top__border"></span>
                    <div class="p-top__imgContainer--panel">
                        <img src="{{ asset('img/time.webp') }}" class="p-top__img--panel" alt="">
                    </div>
                    <p class="p-top__sentence--panel">
                        業者を仲介せず</br>
                        案件発注者・受注者と</br>
                        直接やり取りができるので</br>
                        スピーディーに交渉完了
                    </p>
                </section>
                <section class="p-top__panel">
                    <div class="p-top__number">3</div>
                    <span class="p-top__border"></span>
                    <div class="p-top__imgContainer--panel">

                        <img src="{{ asset('img/notebook.webp') }}" class="p-top__img--panel" alt="">
                    </div>
                    <p class="p-top__sentence--panel">
                        案件発注も簡単</br>
                        タイトル・種別・金額・内容を</br>
                        入力するだけでOK!
                    </p>
                </section>
            </div>
        </div>
        <div class="p-top__content--sub">
            <div class="p-top__titleContainer">
                <span class="p-top__border--title"></span>
                <h1 class="p-top__title--sub">ビジネスは時間との戦い</h1>
                <span class="p-top__border--title"></span>
            </div>
            <p class="p-top__sentence--sub">ビジネスは時間との戦いです。</br>
                いかにして顧客の望むサービスを提供するか？</br>
                これに対してmatchはスピードで応えます。</br>
                登録時の長々とした情報の入力は極力少なくし、業者の仲介無しに顧客同士の直接のやり取りを実現します。</br>
                ビジネスにとって重要な資源である時間を効率的に使うことで案件発注者、
                受注者双方が納得のいく価値を創造しませんか？</br>
            </p>
            <a href="{{ route('register') }}" class="c-btn p-top__link--sub">無料でユーザー登録する</a>
        </div>
    </div>
</main>
@endsection

@include('read.footer')