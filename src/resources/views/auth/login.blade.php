@extends('layouts.master')

@section('title', 'ログインページ')

@section('content')

<div class="p-login">
    <h1 class="p-login__title">ログイン</h1>
    <div class="p-login__formContainer">
        <form method="POST" action="{{ route('login') }}" class="p-login__form">
            @csrf
            @error('email')
            <div class="p-login__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-login__part">
                <label for="email" class="p-login__label">メールアドレス</label>
                <input id="email" class="p-login__input" type="email" name="email" :value="old('email')" autofocus autocomplete="username" />
            </div>


            @error('password')
            <div class="p-login__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-login__part">
                <label for="password" class="p-login__label">パスワード</label>
                <input id="password" class="p-login__input"
                    type="password"
                    name="password"
                    autocomplete="current-password" />
            </div>


            <div class="p-login__part">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="p-login__part">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    パスワードを忘れた方はこちら
                </a>
                @endif
            </div>
            <div class="p-login__btnContainer">
                <button class="c-btn">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection