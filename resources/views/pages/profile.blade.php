@extends('layouts.master')

@section('title', 'プロフィール編集')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-profile">
        <div class="p-profile__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>

        <div class="p-profile__content">
            <h1 class="p-profile__title">プロフィール編集</h1>
            <form action="" method="POST" enctype="multipart/form-data" class="p-profile__form">
                @csrf
                @error('user_img')
                <span class="c-errMsg p-profile__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-profile__part--img">
                    <label for="" class="p-profile__label">プロフィール画像</label>
                    <div class="p-profile__imgContainer">
                        @if($user->user_img == null)
                        <img src="{{ asset('img/person.jpg') }}" class="c-img p-profile__img" alt="">
                        @else
                        <img src="{{ '/' . $user->user_img }}" class="c-img p-profile__img" alt="">
                        @endif
                        <label for="user_img" class="p-profile__inputArea">
                            <input type="file" class="p-profile__input--img" name="user_img">
                            画像ファイルを選択する
                        </label>
                    </div>
                </div>

                @error('name')
                <span class="c-errMsg p-profile__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-profile__part">
                    <div class="p-profile__labelContainer">
                        <label for="name" class="p-profile__label">ニックネーム
                        </label>
                        <div class="p-profile__requireContainer">
                            <span class="p-profile__require">必須</span>
                        </div>
                    </div>
                    <input type="text" id="js-count-name" class="p-profile__input" name="name" value="{{ $user->name }}" placeholder="半角英数字20文字以内で入力してください">
                    <div class="p-profile__countArea">
                        <span class="c-countArea--short js-show-count-name">0</span>/20
                    </div>
                </div>

                @error('email')
                <span class="c-errMsg p-profile__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-profile__part">
                    <div class="p-profile__labelContainer">
                        <label for="email" class="p-profile__label">メールアドレス
                        </label>
                        <div class="p-profile__requireContainer">
                            <span class="p-profile__require">必須</span>
                        </div>
                    </div>
                    <input type="email" class="p-profile__input" name="email" value="{{ $user->email }}">
                </div>

                @error('comment')
                <span class="c-errMsg p-profile__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-profile__part">
                    <label for="comment" class="p-profile__label">自己紹介</label>
                    <textarea name="comment" cols="30" rows="10" id="js-count-text" class="p-profile__textarea" placeholder="10000文字以内で入力してください">{{ $user->comment }}</textarea>
                    <div class="p-profile__countArea">
                        <span class="c-countArea--long js-show-count-text">0</span>/10000
                    </div>
                </div>

                <div class="p-profile__button">
                    <button type="submit" class="c-btn p-profile__btn">
                        変更
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@include('read.footer')