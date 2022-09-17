@extends('layouts.master')

@section('title', '退会手続き')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-deleteconfirm__modal js-show-modal-target">
        <p class="p-deleteconfirm__sentence">退会しますか?</p>
        <form method="POST" action="{{ route('deleteUsers', auth()->user()->id) }}" class="p-deleteconfirm__form">
            @csrf
            <div class="p-deleteconfirm__button--modal">
                <button type="button" class="c-btn p-deleteconfirm__modalBtn js-hide-modal">キャンセル</button>
                <button type="submit" class="c-btn p-deleteconfirm__modalBtn--delete">退会</button>
            </div>
        </form>
    </div>

    <div class="p-deleteconfirm__modal--cover js-show-modal-cover"></div>
    <div class="p-deleteconfirm">
        <div class="p-deleteconfirm__content">
            <h3 class="p-deleteconfirm__title">退会手続き</h3>
            <p class="p-deleteconfirm__content--sentence">退会すると全てのデータが失われます。宜しいですか？</p>
            <div class="p-deleteconfirm__button">
                <button type="button" class="c-btn p-deleteconfirm__btn js-show-modal">
                    退会
                </button>
            </div>
            <a href="{{ route('mypage', auth()->user()->id) }}" class="p-deleteconfirm__link">マイページへ戻る</a>
        </div>
    </div>
</main>
@endsection

@include('read.footer')