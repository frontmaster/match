@extends('layouts.master')

@section('title', '案件投稿')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-postProject">
        <div class="p-postProject__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>
        <div class="p-postProject__content">
            <h1 class="p-postProject__title">案件投稿</h1>
            <form action="{{ route('post.project.create', auth()->user()->id) }}" method="POST" class="p-postProject__form">
                @csrf
                <div class="p-postProject__formContainer">

                    <div class="p-postProject__part">
                        @error('title')
                        <span class="c-errMsg p-postProject__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="p-postProject__labelContainer">
                            <label for="title" class="p-postProject__label">タイトル
                            </label>
                            <span class="p-postProject__require">必須</span>
                        </div>
                        <input type="text" name="title" id="js-count-title" class="p-postProject__input" value="{{ old('title') }}" placeholder="20文字以内で入力してください">
                        <div class="p-postProject__countArea">
                            <span id="" class="p-postProject__count c-countArea--short js-count-short">0</span>/20
                        </div>
                    </div>

                    <div class="p-postProject__part">
                        @error('category')
                        <span class="c-errMsg p-postProject__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="p-postProject__labelContainer">
                            <label for="category" class="p-postProject__label">案件種別
                            </label>
                            <span class="p-postProject__require">必須</span>
                        </div>
                        <select required name="category" id="priceBox" class="p-postProject__select" onchange="change()">
                            <option value="0" hidden disabled selected>選択してください</option>
                            @foreach($categories as $category)
                            @if($category->id == old('category'))
                            <option value="{{ optional($category)->id }}" selected>{{ optional($category)->category_name }}</option>
                            @else
                            <option value="{{ optional($category)->id }}">{{ optional($category)->category_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="p-postProject__part--price js-price-show">
                        @error('low_price')
                        <span class="c-errMsg p-postProject__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        @error('high_price')
                        <span class="c-errMsg p-postProject__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="p-postProject__labelContainer">
                            <label for="price" class="p-postProject__label">金額
                            </label>
                            <span class="p-postProject__require">必須</span>
                        </div>
                        <div class="p-postProject__priceContainer">
                            <div class="p-postProject__pricePart">
                                <h3 class="p-postProject__priceTitle">下限金額</h3>
                                <input type="number" name="low_price" class="p-postProject__input--price js-clear1" value="{{ old('low_price') }}" placeholder="1~4桁の整数">
                            </div>
                            <div class="p-postProject__priceUnit">
                                <span>千円</span>
                            </div>

                            <div class="p-postProject__tilde">
                                <span>〜</span>
                            </div>
                            <div class="p-postProject__pricePart">
                                <h3 class="p-postProject__priceTitle">上限金額</h3>
                                <input type="number" name="high_price" class="p-postProject__input--price js-clear2" value="{{ old('high_price') }}" placeholder="1~4桁の整数">
                            </div>
                            <div class="p-postProject__priceUnit">
                                <span>千円</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-postProject__part">
                        @error('content')
                        <span class="c-errMsg p-postProject__errMsg">
                            {{ $message }}
                        </span>
                        @enderror
                        <div class="p-postProject__label">
                            <label for="content" class="p-postProject__label">内容
                            </label>
                            <span class="p-postProject__require">必須</span>
                        </div>
                        <textarea name="content" cols="30" rows="10" id="js-count-content" class="p-postProject__textarea" placeholder="5000文字以内で入力してください">{{ old('content') }}</textarea>
                        <div class="p-postProject__countArea">
                            <span id="" class="p-postProject__count c-countArea--long js-count-long">0</span>/5000
                        </div>
                    </div>
                    <div class="p-postProject__button">
                        <button type="submit" class="c-btn p-postProject__btn">投稿</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@include('read.footer')