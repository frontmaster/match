@extends('layouts.master')

@section('title', '案件詳細ページ')

@section('content')
<div class="c-modal__cover js-show-modal-cover">
    <div class="c-modal js-show-modal-target">
        <p class="c-modal__sentence">
            案件に応募しますか？
        </p>

        <div class="c-modal__btn">
            <button class="c-modal__close js-hide-modal">×</button>
            <button type="button" class="c-btn c-modal__cancel js-hide-modal">
                キャンセル
            </button>
            <button type="button" class="c-btn c-modal__confirm js-submit-main-form">
                応募
            </button>
        </div>
    </div>
</div>
<h2 class="p-detailProject__title">案件詳細</h2>
@if(session('success'))
<div class="c-success">
    {{ session('success') }}
</div>
@endif
<div class="p-detailProject__formContainer">
    <div class="p-detailProject__form">
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
        <div id="" class="p-detailProject__itemContainer">

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
        @if(!$applyProject && !$postProject)
        <form method="POST" action="{{ route('applyProjects.store', $project) }}" class="c-modal__form">
            @csrf
            <button type="button" class="c-btn p-detailProject__btn js-show-modal">応募する</button>
        </form>
        @elseif($applyProject)
        <button type="submit" class="c-btn p-detailProject__btn--disable">応募済みです</button>
        @elseif($postProject)
        <button type="submit" class="c-btn p-detailProject__btn--disable">自分が登録した案件には応募できません</button>
        @endif
    </div>
    <h3 class="p-detailProject__title--msg">メッセージ一覧</h3>
    <div class="p-detailProject__form--msg">
        @if($comments->isEmpty())
        <p class="p-detailProject__emptyMsg">まだメッセージはありません</p>
        @else
        @foreach($comments as $comment)
        @if($comment->user_id === Auth::id())
        <div class="p-detailProject__msgContainer--author">
            <div class="p-detailProject__msg--author">
                <p class="p-detailProject__comment--author">{{ $comment->comment }}</p>
            </div>
        </div>
        @else
        <div class="p-detailProject__msgContainer">
            <img src="{{ $comment->user->image ? asset('storage/img/' . $user->image) : asset('img/person.jpg') }}" class="p-detailProject__img" alt="プロフィール画像">
            <div class="p-detailProject__msg">
                <p class="p-detailProject__name">{{ $comment->user->nickname }}</p>
                <p class="p-detailProject__comment">{{ $comment->comment }}</p>
            </div>
        </div>
        @endif
        @endforeach
        @endif
    </div>
    <h3 class="p-detailProject__title--msg">メッセージを送る</h3>
    <form method="POST" action="{{ route('comments.store', $project) }}" class="p-detailProject__form">
        @csrf
        @error('comment')
        <p class="c-errMsg">{{ $message }}</p>
        @enderror
        <textarea name="comment" id="" class="p-detailProject__textarea--msg"></textarea>
        <button type="submit" class="c-btn p-detailProject__btn">送信</button>
    </form>
</div>
@endsection