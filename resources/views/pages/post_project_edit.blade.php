@extends('layouts.master')

@section('title', '案件編集')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-postProjectEdit">
        <div class="p-postProjectEdit__modal js-show-modal-target">
            <p class="p-postProjectEdit__sentence">案件を削除しますか?</p>
            <form method="POST" action="{{ route('post.project.delete', $postProjects->id) }}" class="p-postProjectEdit__form--modal">
                @method('DELETE')
                @csrf
                <div class="p-postEdit__button--modal">
                    <button type="button" class="c-btn p-postProjectEdit__btn--cancel js-hide-modal">キャンセル</button>
                    <button type="submit" class="c-btn p-postProjectEdit__btn--delete">削除</button>
                </div>
            </form>
        </div>
        <div class="p-postProjectEdit__modal--cover js-show-modal-cover"></div>
        <div class="p-postProjectEdit__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>
        <div class="p-postProjectEdit__content">
            <h1 class="p-postProjectEdit__title">案件編集</h1>
            <form action="{{ route('post.project.update', $postProjects->id) }}" method="POST" class="p-postProjectEdit__form">
                @csrf
                <div class="p-postProjectEdit__formContainer">

                    <div class="p-postProjectEdit__part">
                        @error('title')
                        <span class="c-errMsg p-postProjectEdit__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        <label for="title" class="p-postProjectEdit__label">タイトル
                            <span class="p-postProjectEdit__require">必須</span>
                        </label>
                        <input type="text" name="title" id="js-count-title" class="p-postProjectEdit__input" value="{{ old('title', $postProjects->title) }}" placeholder="20文字以内で入力してください">
                        <div class="p-postProjectEdit__countArea">
                            <span id="" class="p-postProjectEdit__count c-countArea--short js-count-short">0</span>/20
                        </div>
                    </div>

                    <div class="p-postProjectEdit__part">
                        @error('category')
                        <span class="c-errMsg p-postProjectEdit__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        <label for="category" class="p-postProjectEdit__label">案件種別
                            <span class="p-postProjectEdit__require">必須</span>
                        </label>
                        <select required name="category" id="priceBox" class="p-postProjectEdit__select js-priceClear" onchange="change()">
                            <option value="0" hidden disabled selected>選択してください</option>
                            @foreach($categories as $category)
                            @if(!is_null(old('category')))
                            @if($category->id == old('category'))
                            <option value="{{ optional($category)->id }}" selected>{{ optional($category)->category_name }}</option>
                            @else
                            <option value="{{ optional($category)->id }}">{{ optional($category)->category_name }}</option>
                            @endif
                            @else
                            @if($category->id == $postProjects->category_id)
                            <option value="{{ optional($category)->id }}" selected>{{ optional($category)->category_name }}</option>
                            @else
                            <option value="{{ optional($category)->id }}">{{ optional($category)->category_name }}</option>
                            @endif
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="p-postProjectEdit__part--price js-price-show">
                        @error('low_price')
                        <span class="c-errMsg p-postProjectEdit__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        @error('high_price')
                        <span class="c-errMsg p-postProjectEdit__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        <label for="price" class="p-postProjectEdit__label">金額
                            <span class="p-postProjectEdit__require">必須</span>
                        </label>
                        <div class="p-postProjectEdit__priceContainer">
                            <div class="p-postProjectEdit__pricePart">
                                <h3 class="p-postProjectEdit__priceTitle">下限金額</h3>
                                <input type="number" name="low_price" class="p-postProjectEdit__input--price js-clear1" value="{{ old('low_price', $postProjects->low_price) }}" placeholder="1~4桁の整数で入力してください">
                            </div>
                            <div class="p-postProjectEdit__priceUnit">
                                <span>千円</span>
                            </div>

                            <div class="p-postProjectEdit__tilde">
                                <span>〜</span>
                            </div>
                            <div class="p-postProjectEdit__pricePart">
                                <h3 class="p-postProjectEdit__priceTitle">上限金額</h3>
                                <input type="number" name="high_price" class="p-postProjectEdit__input--price js-clear2" value="{{ old('high_price', $postProjects->high_price) }}" placeholder="1~4桁の整数で入力してください">
                            </div>
                            <div class="p-postProjectEdit__priceUnit">
                                <span>千円</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-postProjectEdit__part">
                        @error('content')
                        <span class="c-errMsg p-postProjectEdit__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        <label for="content" class="p-postProjectEdit__label">内容
                            <span class="p-postProjectEdit__require">必須</span>
                        </label>
                        <textarea name="content" cols="30" rows="10" id="js-count-content" class="p-postProjectEdit__textarea" placeholder="5000文字以内で入力してください">{{ old('content', $postProjects->content) }}</textarea>
                        <div class="p-postProjectEdit__countArea">
                            <span id="" class="p-postProjectEdit__count c-countArea--long js-count-long">0</span>/5000
                        </div>
                    </div>
                    @if($applyProject)
                    <div class="p-postProjectEdit__button--disabled">
                        <button type="submit" class="c-btn p-postProjectEdit__btn--disabled">すでに応募者がいるため編集できません</button>
                    </div>
                    @else
                    <div class="p-postProjectEdit__button">
                        <button type="submit" class="c-btn p-postProjectEdit__btn">編集</button>
                        <button type="button" class="c-btn p-postProjectEdit__btn--delete js-show-modal">削除</button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@include('read.footer')