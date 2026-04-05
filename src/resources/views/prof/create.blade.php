@extends('layouts.master')

@section('title', 'プロフィール編集ページ')

@section('content')
<h1 class="p-profile__title">プロフィール編集</h1>
<div class="p-profile">
    @if(session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif
    <div class="p-profile__formContainer">
        <form action="{{ route('profiles.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="p-profile__form">
            @csrf
            @method('PUT')

            @error('image')
            <div class="p-profile__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-profile__itemContainer">
                <div class="p-profile__item">
                    <label for="" class="p-profile__label">プロフィール画像</label>
                    <div class="p-profile__imgContainer">
                        <img src="{{ $user->image ? asset('storage/img/' . $user->image) : asset('img/person.jpg') }}" class="p-profile__img" alt="プロフィール画像">
                        <input type="file" name="image" class="p-profile__imgInput">
                    </div>
                </div>
            </div>

            @error('nickname')
            <div class="p-profile__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-profile__itemContainer">
                <div class="p-profile__item">
                    <label for="" class="p-profile__label">ニックネーム</label>
                    <input type="text" name="nickname" class="p-profile__input" value="{{ old('nickname', $user->nickname) }}">
                </div>
            </div>


            @error('email')
            <div class="p-profile__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-profile__itemContainer">
                <div class="p-profile__item">
                    <label for="" class="p-profile__label">メールアドレス</label>
                    <input type="email" name="email" class="p-profile__input" value="{{ old('email', $user->email) }}">
                </div>
            </div>

            @error('bio')
            <div class="p-profile__errMsg c-errMsg">{{ $message }}</div>
            @enderror
            <div class="p-profile__itemContainer">
                <div class="p-profile__item">
                    <label for="" class="p-profile__label">自己紹介</label>
                    <textarea name="bio" id="" class="p-profile__textarea">{{ old('bio', $user->bio) }}</textarea>
                </div>
            </div>
            <div class="p-profile__btnContainer">
                <button type="submit" class="c-btn">変更</button>
            </div>
        </form>
    </div>
</div>
@endsection