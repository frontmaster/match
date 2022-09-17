@extends('layouts.master')

@section('title', '応募案件詳細')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-projectDetail">
        <div class="p-projectDetail__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>
        <div class="p-projectDetail__content">
            <h1 class="p-projectDetail__title">案件詳細</h1>
            <div class="p-projectDetail__formContainer">
                <div class="p-projectDetail__part">
                    <label for="" class="p-projectDetail__label">応募者</label>
                    <div class="p-projectDetail__postUserInfo">
                        @if($applyUserImg)
                        <img src="{{ '/' . $applyUserImg }}" alt="" class="p-projectDetail__img">
                        @else
                        <img src="{{ asset('img/person.jpg') }}" alt="" class="p-projectDetail__img">
                        @endif
                        <div class="p-projectDetail__postUserName">{{ $applyUserName }}</div>
                    </div>
                </div>
                <div class="p-projectDetail__part">
                    <label for="title" class="p-projectDetail__label">タイトル</label>
                    <input type="text" name="title" id="js-count-title" class="p-projectDetail__input" value="{{ $applyProject->title }}" readonly>
                    <div class="p-projectDetail__countArea">
                        <span id="" class="p-projectDetail__count c-countArea--short js-count-short">0</span>/20
                    </div>
                </div>

                <div class="p-projectDetail__part">
                    <label for="category" class="p-projectDetail__label">案件種別</label>
                    <input type="text" class="p-projectDetail__input--select" value="{{ $applyProject->category->category_name }}" readonly>
                </div>
                @if($applyProject->category_id == 1)
                <div class="p-projectDetail__part--price js-price-show">
                    <label for="price" class="p-projectDetail__label">金額</label>
                    <div class="p-projectDetail__priceContainer">
                        <div class="p-projectDetail__pricePart">
                            <h3 class="p-projectDetail__priceTitle">下限金額</h3>
                            <input type="number" name="low_price" class="p-projectDetail__input--price" value="{{ $applyProject->low_price }}" readonly>
                        </div>
                        <div class="p-projectDetail__priceUnit">
                            <span>千円</span>
                        </div>

                        <div class="p-projectDetail__tilde">
                            <span>〜</span>
                        </div>
                        <div class="p-projectDetail__pricePart">
                            <h3 class="p-projectDetail__priceTitle">上限金額</h3>
                            <input type="number" name="high_price" class="p-projectDetail__input--price" value="{{ $applyProject->high_price }}" readonly>
                        </div>
                        <div class="p-projectDetail__priceUnit">
                            <span>千円</span>
                        </div>
                    </div>
                </div>
                @endif
                <div class="p-projectDetail__part">

                    <label for="content" class="p-projectDetail__label">内容

                    </label>
                    <textarea name="content" cols="30" rows="10" id="js-count-content" class="p-projectDetail__textarea" readonly>{{ $applyProject->content }}</textarea>
                    <div class="p-projectDetail__countArea">
                        <span id="" class="p-projectDetail__count c-countArea--long js-count-long">0</span>/5000
                    </div>
                </div>



            </div>
            <div class="p-projectDetail__msgContainer">
                <h1 class="p-projectDetail__title">メッセージ一覧</h1>
                @if($directMessages)
                <div class="p-projectDetail__msgList">
                    @foreach($directMessages as $msg)
                    @if($msg->project_id == $postProjectID && $user_id != $msg->sender_id && $msg->sender_id == $msg->apply_user_id)
                    <div class="p-projectDetail__msgPart--left">
                        <div class="p-projectDetail__postUserInfo--msg">
                            <span class="p-projectDetail__postUser">応募者</span>
                            @if($msg->applyUser->user_img)
                            <img src="{{ '/' . $msg->applyUser->user_img }}" alt="" class="p-projectDetail__img">
                            @else
                            <img src="{{ asset('img/person.jpg') }}" alt="" class="p-projectDetail__img">
                            @endif
                        </div>
                        <div class="p-projectDetail__postUserName">{{ $msg->applyUser->name }}</div>
                        <div class="p-projectDetail__msg--left">{{ $msg->msg }}</div>
                    </div>
                    @elseif($msg->project_id == $postProjectID && $user_id != $msg->sender_id && $msg->sender_id == $msg->post_user_id)
                    <div class="p-projectDetail__msgPart--left">
                        <div class="p-projectDetail__postUserInfo--msg">
                            <span class="p-projectDetail__postUser">投稿者</span>
                            @if($msg->postUser->user_img)
                            <img src="{{ '/' . $msg->postUser->user_img }}" alt="" class="p-projectDetail__img">
                            @else
                            <img src="{{ asset('img/person.jpg') }}" alt="" class="p-projectDetail__img">
                            @endif
                        </div>
                        <div class="p-projectDetail__postUserName">{{ $msg->postUser->name }}</div>
                        <div class="p-projectDetail__msg--left">{{ $msg->msg }}</div>
                    </div>
                    @elseif($msg->project_id == $postProjectID && $user_id == $msg->sender_id)
                    <div class="p-projectDetail__msgPart--right">
                        <div class="p-projectDetail__msg--right">{{ $msg->msg }}</div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @else
                <p>まだメッセージはありません</p>
                @endif
            </div>
            <div class="p-projectDetail__formContainer">
                <h1 class="p-projectDetail__title">メッセージを送る</h1>
                <form method="POST" action="{{ route('send.directMsg', $applyProjectID) }}" class="p-projectDetail__form">
                    @csrf
                    @error('msg')
                    <span class="c-errMsg p-postProject__errMsg">
                        {{ $message }}
                    </span>
                    @enderror
                    <textarea name="msg" id="js-count-msg" cols="30" rows="10" class="p-projectDetail__msg"></textarea>
                    <div class="p-projectDetail__countArea">
                        <span id="" class="p-projectDetail__count c-countArea--msg js-count-msg">0</span>/5000
                    </div>
                    <div class="p-projectDetail__button">
                        <button type="submit" class="c-btn p-projectDetail__btn">送信</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@include('read.footer')