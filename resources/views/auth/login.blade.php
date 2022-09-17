@extends('layouts.master')

@section('title', 'ログインページ')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-login">
        <div class="p-login__content">
            <h1 class="p-login__title">ログイン</h1>
            <form method="POST" action="{{ route('login') }}" class="p-login__form">
                @csrf
                @error('email')
                <span class="c-errMsg p-login__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-login__part">
                    <label for="email" class="p-login__label">メールアドレス</label>

                    <input type="email" class="p-login__input @error('email') is-error @enderror" name="email" value="{{ old('email') }}">
                </div>

                @error('password')
                <span class="c-errMsg p-login__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-login__part">
                    <label for="password" class="p-login__label">パスワード</label>

                    <input type="password" class="p-login__input @error('password') is-error @enderror" name="password">
                </div>

                <div class="p-login__button">
                    <button type="submit" class="c-btn p-login__btn">
                        ログイン
                    </button>
                </div>
            </form>
            <a href="{{ route('password.request') }}" class="p-login__link">パスワードを忘れた方はこちら</a>
        </div>
    </div>
</main>
@endsection

@include('read.footer')