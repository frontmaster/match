@extends('layouts.master')

@section('title', '案件詳細ページ')

@section('content')
<h2 class="p-detailProject__title">案件詳細</h2>
<div class="p-detailProject__formContainer">
    <form method="POST" action="{{ route('projects.store') }}" class="p-detailProject__form">
        @csrf
        <div class="p-detailProject__itemContainer">
            <div class="p-detailProject__item">
                <div class="p-detailProject__labelContainer">
                    <label for="project_title" class="p-detailProject__label">案件名</label>
                </div>
                <p>{{ $project->project_title }}</p>
            </div>
        </div>

        <div class="p-detailProject__itemContainer">
            <div class="p-detailProject__item--projectType">
                <div class="p-detailProject__labelContainer">
                    <label for="" class="p-detailProject__label">案件種別</label>
                </div>

                <div class="p-detailProject__radioContainer">
                    @if($project->project_type === 'single')
                    <p>単発案件</p>
                    @else
                    <p>レベニューシェア案件</p>
                    @endif
                </div>
            </div>
        </div>
        @if($project->project_type === 'single')
        <div id="" class="">
            <div class="p-detailProject__item--projectType">
                <div class="p-detailProject__labelContainer">
                    <label for="price" class="p-detailProject__label" class="p-detailProject__input">金額</label>
                </div>
                <div class="p-detailProject__inputContainer">
                    <p>{{ $project->price_min }}</p>
                    <span>千円</span>
                    <span class="p-detailProject__separator">〜</span>
                    <p>{{ $project->price_max }}</p>
                    <span>千円</span>
                </div>
            </div>
        </div>
        @endif

        <div class="p-detailProject__itemContainer">
            <div class="p-detailProject__item">
                <div class="p-detailProject__labelContainer">
                    <label for="content" class="p-detailProject__label">内容</label>
                </div>
                <div name="content" id="content" class="p-detailProject__textarea">{{ $project->content }}</div>
            </div>
        </div>
        <div class="p-detailProject__btnContainer">
            <button type="button" class="c-btn p-detailProject__btn js-show-modal">登録</button>
        </div>
    </form>
    <a href="{{ route('mypages.index')}}">マイページへ戻る</a>
</div>
@endsection