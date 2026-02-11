@extends('layouts.master')

@section('title', '案件登録ページ')

@section('content')
<div class="p-createProject__modal--cover js-show-modal-cover">
    <div class="p-createProject__modal js-show-modal-target">
        <p class="p-createProject__sentence--modal">
            案件を登録しますか？
        </p>

        <div class="p-createProject__btn--modal">
            <button class="p-createProject__modalClose js-hide-modal">×</button>
            <button type="button" class="c-btn p-createProject__btn--cancel js-hide-modal">
                キャンセル
            </button>
            <button type="button" class="c-btn p-createProject__btn--buy js-submit-main-form">
                登録
            </button>
        </div>
    </div>
</div>

<h2 class="p-createProject__title">案件登録</h2>
@if(session('success'))
<div class="c-success">
    {{ session('success') }}
</div>
@endif
<div class="p-createProject__formContainer">
    <form method="POST" action="{{ route('projects.store') }}" class="p-createProject__form">
        @csrf
        <div class="p-createProject__itemContainer">
            <div class="p-createProject__item">
                <div class="p-createProject__labelContainer">
                    <label for="project_title" class="p-createProject__label">案件名</label>
                    <span class="c-require">必須</span>
                </div>
                <input type="text" id="project_title" name="project_title" class="p-createProject__input" value="{{ old('project_title') }}">
                @error('project_title')
                <div class="p-createProject__errMsg c-errMsg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="p-createProject__itemContainer">
            <div class="p-createProject__item--projectType">
                <div class="p-createProject__labelContainer">
                    <label for="" class="p-createProject__label">案件種別</label>
                    <span class="c-require">必須</span>
                </div>

                <div class="p-createProject__radioContainer">
                    <label for="single">単発案件</label>
                    <input type="radio" id="single" name="project_type" value="single" {{ old('project_type') == 'single' ? 'checked' : '' }}>
                    <label for="revenue">レベニューシェア案件案件</label>
                    <input type="radio" id="revenue" name="project_type" value="revenue" {{ old('project_type') == 'revenue' ? 'checked' : '' }}>
                </div>
                @error('project_type')
                <div class="p-createProject__errMsg c-errMsg">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div id="priceField" class="p-createProject__itemContainer">
            <div class="p-createProject__item--price">
                <div class="p-createProject__labelContainer">
                    <label for="price" class="p-createProject__label" class="p-createProject__input">金額</label>
                    <span class="c-require">必須</span>
                </div>
                <div class="p-createProject__inputContainer">
                    <input type="number" id="price" name="price" class="p-createProject__input--price" value="{{ old('price') }}">
                    <span>円</span>
                </div>
                @error('price')
                <div class="p-createProject__errMsg c-errMsg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="p-createProject__itemContainer">
            <div class="p-createProject__item">
                <div class="p-createProject__labelContainer">
                    <label for="content" class="p-createProject__label">内容</label>
                    <span class="c-require">必須</span>
                </div>
                <textarea name="content" id="content" class="p-createProject__textarea">{{ old('content') }}</textarea>
                @error('content')
                <div class="p-createProject__errMsg c-errMsg">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="p-createProject__btnContainer">
            <button type="button" class="c-btn p-createProject__btn js-show-modal">登録</button>
        </div>
    </form>
</div>
@endsection