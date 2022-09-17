@extends('layouts.master')

@section('title', 'パスワードリセット画面')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main">
    <div class="p-passChange">
        <div class="p-passChange__content">
            <h1 class="p-passChange__title">パスワードリセット</h1>
            <p class="p-passChange__sentence">下記の入力欄にメールアドレス、新しいパスワードを入力してください
            </p>
            <form method="POST" action="{{ route('password.update') }}" class="p-passChange__form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                @error('email')
                <span class="c-errMsg p-passChange__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-passChange__part">
                    <label for="email" class="p-passChange__label">メールアドレス</label>
                    <input id="email" type="email" class="p-passChange__input @error('email') is-error @enderror" name="email" value="{{ $email ?? old('email') }}">
                </div>

                @error('password')
                <span class="c-errMsg p-passChange__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-passChange__part">
                    <label for="new_password" class="p-passChange__label">新しいパスワード</label>
                    <input id="password" type="password" class="p-passChange__input @error('password') is-error @enderror" name="password" required autocomplete="new-password">
                </div>

                <div class="p-passChange__part">
                    <label for="password-confirm" class="p-passChange__label">新しいパスワード(確認)</label>
                    <input id="password-confirm" type="password" class="p-passChange__input" name="password_confirmation" required autocomplete="new-password">
                </div>


                <div class="p-passChange__button">
                    <button type="submit" class="c-btn p-passChange__btn">
                        送信
                    </button>
                </div>

            </form>

        </div>
    </div>
    </div>
</main>
@endsection
@include('read.footer')