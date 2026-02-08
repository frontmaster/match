@extends('layouts.master')

@section('title', 'ユーザー登録')

@section('content')

<div class="p-register">
    <h1 class="p-register__title">ユーザー登録</h1>
    <div class="p-register__formContainer">
        <form method="POST" action="{{ route('register') }}" class="p-register__form">
            @csrf

            @error('email')
            <div class="p-register__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-register__part">
                <label for="email" class="p-register__label">メールアドレス</label>
                <input id="email" class="p-register__input" type="email" name="email" :value="old('email')" />
            </div>

            @error('password')
            <div class="p-register__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-register__part">
                <label for="password" class="p-register__label">パスワード</label>
                <input id="password" class="p-register__input"
                    type="password"
                    name="password" />
            </div>

            @error('password_confirmation')
            <div class="p-register__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-register__part">
                <label for="password_confirmation" class="p-register__label">パスワード（再入力）</label>
                <input id="password_confirmation" class="p-register__input"
                    type="password"
                    name="password_confirmation"/>
            </div>






            <div class="p-register__btnContainer">
                <button class="c-btn">登録</button>
            </div>

        </form>
    </div>
</div>
@endsection