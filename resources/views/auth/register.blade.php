@extends('layouts.master')

@section('title', 'ユーザー登録ページ')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-register">
        <div class="p-register__content">
            <h1 class="p-register__title">ユーザー登録</h1>
            <form method="POST" action="{{ route('register') }}" class="p-register__form">
                @csrf
                @error('name')
                <span class="c-errMsg p-register__errMsg">
                    {{ $message }}
                </span>
                @enderror
                <div class="p-register__part--name">
                    <label for="name" class="p-register__label">ニックネーム</label>
                    <div class="p-register__inputContainer">
                        <span class="p-register__require">必須</span>

                        <input type="text" class="p-register__input @error('name') is-error @enderror" name="name" value="{{ Str::random(10) }}" readonly>
                    </div>
                </div>

                @error('email')
                <span class="c-errMsg p-register__errMsg">
                    {{ $message }}
                </span>
                @enderror
                <div class="p-register__part">
                    <label for="email" class="p-register__label">メールアドレス</label>

                    <div class="p-register__inputContainer">
                        <span class="p-register__require">必須</span>

                        <input type="email" class="p-register__input @error('email') is-error @enderror" name="email" value="{{ old('email') }}" placeholder="半角英数">
                    </div>
                </div>

                @error('password')
                <span class="c-errMsg p-register__errMsg">
                    {{ $message }}
                </span>
                @enderror
                <div class="p-register__part">
                    <label for="password" class="p-register__label">パスワード</label>
                    <div class="p-register__inputContainer">
                        <span class="p-register__require">必須</span>

                        <input type="password" class="p-register__input @error('password') is-error @enderror" name="password" placeholder="半角英数8文字以上">
                    </div>
                </div>

                @error('password')
                <span class="c-errMsg p-register__errMsg">
                    {{ $message }}
                </span>
                @enderror
                <div class="p-register__part">
                    <label for="password_confirm" class="p-register__label">パスワード再入力</label>
                    <div class="p-register__inputContainer">
                        <span class="p-register__require">必須</span>

                        <input type="password" class="p-register__input @error('password-confirm') is-error @enderror" name="password_confirmation">
                    </div>
                </div>
                <div class="p-register__button">
                    <button type="submit" class="c-btn p-register__btn">
                        登録
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@include('read.footer')