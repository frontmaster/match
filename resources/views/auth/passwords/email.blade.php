@extends('layouts.master')

@section('title', 'パスワード再発行手続き')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main">
    <div class="p-passReset">
        <div class="p-passReset__content">
            <h1 class="p-passReset__title">パスワード再発行手続き</h1>
            <p class="p-passReset__sentence">下記のメールアドレス入力欄に、登録したメールアドレスを入力してください。</br>
                メールアドレス宛にパスワード再発行用のURLと認証キーをお送りします。
            </p>
            <form method="POST" action="{{ route('password.email') }}" class="p-passReset__form">
                @csrf
                <div class="p-passReset__part">
                    <label for="email" class="p-passReset__label">メールアドレス</label>
                    @error('email')
                    <span class="c-errMsg p-passReset__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                    <input type="email" class="p-passReset__input @error('email') is-error @enderror" name="email" value="{{ old('email') }}" placeholder="半角英数">
                </div>
                <div class="p-passReset__button">
                    <button type="submit" class=" c-btn p-passReset__btn">
                        送信
                    </button>
                </div>
            </form>
            <a href="{{ route('login') }}" class="p-passReset__link">ログイン画面へ戻る</a>
        </div>
    </div>
</main>


@endsection

@include('read.footer')