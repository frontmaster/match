@extends('layouts.master')

@section('title', '案件詳細')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-projectDetail">
        <div class="p-projectDetail__modal js-show-modal-target">
            <p class="p-projectDetail__sentence--modal">案件に応募しますか?</p>
            <form method="POST" action="{{ route('post.project.apply', $postProjects->id) }}" class="p-projectDetail__form--modal">
                @csrf
                <div class="p-projectDetail__button--modal">
                    <button type="button" class="c-btn p-projectDetail__btn--cancel js-hide-modal">キャンセル</button>
                    <button type="submit" class="c-btn p-projectDetail__btn--apply">応募</button>
                </div>
            </form>
        </div>
        <div class="p-projectDetail__modal--cover js-show-modal-cover"></div>
        <div class="p-projectDetail__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>
        <div class="p-projectDetail__content">
            <h1 class="p-projectDetail__title">案件詳細</h1>


            <div class="p-projectDetail__formContainer">
                <div class="p-projectDetail__part">
                    <label for="" class="p-projectDetail__label">投稿者</label>
                    <div class="p-projectDetail__postUserInfo">
                        @if($postUserImg)
                        <img src="{{ '/' . $postUserImg }}" alt="" class="p-projectDetail__img">
                        @else
                        <img src="{{ asset('img/person.jpg') }}" alt="" class="p-projectDetail__img">
                        @endif
                        @if($postProjects->user->deleted_at != null)
                        <div class="p-projectDetail__postUserName">{{ $postUserName }}(退会したユーザー)</div>
                        @else
                        <div class="p-projectDetail__postUserName">{{ $postUserName }}</div>
                        @endif
                    </div>
                </div>
                <div class="p-projectDetail__part">
                    <label for="title" class="p-projectDetail__label">タイトル</label>
                    <input type="text" name="title" id="js-count-title" class="p-projectDetail__input" value="{{ $postProjects->title }}" readonly>
                    <div class="p-projectDetail__countArea">
                        <span id="" class="p-projectDetail__count c-countArea--short js-count-short">0</span>/20
                    </div>
                </div>

                <div class="p-projectDetail__part">
                    <label for="category" class="p-projectDetail__label">案件種別</label>
                    <input type="text" class="p-projectDetail__input--select" value="{{ $category->category_name }}" readonly>
                </div>
                @if($postProjects->category_id == 1)
                <div class="p-projectDetail__part--price js-price-show">
                    <label for="price" class="p-projectDetail__label">金額</label>
                    <div class="p-projectDetail__priceContainer">
                        <div class="p-projectDetail__pricePart">
                            <h3 class="p-projectDetail__priceTitle">下限金額</h3>
                            <input type="number" name="low_price" class="p-projectDetail__input--price" value="{{ $postProjects->low_price }}" readonly>
                        </div>
                        <div class="p-projectDetail__priceUnit">
                            <span>千円</span>
                        </div>

                        <div class="p-projectDetail__tilde">
                            <span>〜</span>
                        </div>
                        <div class="p-projectDetail__pricePart">
                            <h3 class="p-projectDetail__priceTitle">上限金額</h3>
                            <input type="number" name="high_price" class="p-projectDetail__input--price" value="{{ $postProjects->high_price }}" readonly>
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
                    <textarea name="content" cols="30" rows="10" id="js-count-content" class="p-projectDetail__textarea" readonly>{{ $postProjects->content }}</textarea>
                    <div class="p-projectDetail__countArea">
                        <span id="" class="p-projectDetail__count c-countArea--long js-count-long">0</span>/5000
                    </div>
                </div>


                <div class="p-projectDetail__buttonContainer--disabled">
                    @if($applyProjects)
                    <div class="p-projectDetail__button--disabled">
                        <button type="button" class="c-btn p-projectDetail__btn--disabled" disabled>すでに応募しています</button>
                    </div>
                    @if(!$already_liked)
                    <div class="p-projectDetail__likeContainer">
                        <span class="p-projectDetail__likeMsg">いいね!</span>
                        <div class="p-projectDetail__heartContainer">
                            <i class="fas fa-heart js-click-good p-projectDetail__btn--good" data-projectid="{{$project_id}}"></i>
                            <span class="js-like-count">{{$likes->count()}}</span>
                        </div>
                    </div>
                    @else
                    <div class="p-projectDetail__likeContainer">
                        <span class="p-projectDetail__likeMsg">いいね!</span>
                        <div class="p-projectDetail__heartContainer">
                            <i class="fas fa-heart js-click-good p-projectDetail__btn--good best" data-projectid="{{ $project_id}}"></i>
                            <span class="js-like-count">{{$likes->count()}}</span>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
                <div class="p-projectDetail__buttonContainer--disabled">
                    @if($postUserID == auth()->user())
                    <div class="p-projectDetail__button--disabled">
                        <button type="button" class="c-btn p-projectDetail__btn--disabled" disabled>案件投稿者は応募できません</button>
                    </div>
                    @if(!$already_liked)
                    <div class="p-projectDetail__likeContainer">
                        <span class="p-projectDetail__likeMsg">いいね!</span>
                        <div class="p-projectDetail__heartContainer">
                            <i class="fas fa-heart js-click-good p-projectDetail__btn--good" data-projectid="{{$project_id}}"></i>
                            <span class="js-like-count">{{$likes->count()}}</span>
                        </div>
                    </div>
                    @else
                    <div class="p-projectDetail__likeContainer">
                        <span class="p-projectDetail__likeMsg">いいね!</span>
                        <div class="p-projectDetail__heartContainer">
                            <i class="fas fa-heart js-click-good p-projectDetail__btn--good best" data-projectid="{{ $project_id}}"></i>
                            <span class="js-like-count">{{$likes->count()}}</span>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>

                @if($postUser == null)
                <div class="p-projectDetail__buttonContainer--withdrawUser">
                    <div class="p-projectDetail__button--withdrawUser">
                        <button type="button" class="c-btn p-projectDetail__btn--disabled" disabled>案件投稿者が退会しているため応募できません</button>
                    </div>
                </div>
                @endif

                @if(!$applyProjects && $postUserID != auth()->user() && $postUser != null)
                <div class="p-projectDetail__buttonContainer">
                    <div class="p-projectDetail__button">
                        <button type="button" class="c-btn p-projectDetail__btn js-show-modal">応募</button>
                    </div>

                    @if(!$already_liked)
                    <div class="p-projectDetail__likeContainer">
                        <span class="p-projectDetail__likeMsg">いいね!</span>
                        <div class="p-projectDetail__heartContainer">
                            <i class="fas fa-heart js-click-good p-projectDetail__btn--good" data-projectid="{{$project_id}}"></i>
                            <span class="js-like-count">{{$likes->count()}}</span>
                        </div>
                    </div>
                    @else
                    <div class="p-projectDetail__likeContainer">
                        <span class="p-projectDetail__likeMsg">いいね!</span>
                        <div class="p-projectDetail__heartContainer">
                            <i class="fas fa-heart js-click-good p-projectDetail__btn--good best" data-projectid="{{ $project_id}}"></i>
                            <span class="js-like-count">{{$likes->count()}}</span>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <div class="p-projectDetail__msgContainer">
                <h1 class="p-projectDetail__title">メッセージ一覧</h1>
                @if($publicMsg)
                <div class="p-projectDetail__msgList">
                    @foreach($publicMsgs as $msg)
                    @if($msg->sender->id == $postProjects->post_user_id && $msg->sender->id != $user_id && $msg->project->id == $project_id)
                    <div class="p-projectDetail__msgPart--left">
                        <div class="p-projectDetail__postUserInfo--msg">
                            <span class="p-projectDetail__postUser">投稿者</span>
                            @if($msg->sender->user_img)
                            <img src="{{ '/' . $msg->sender->user_img }}" alt="" class="p-projectDetail__img">
                            @else
                            <img src="{{ asset('img/person.jpg') }}" alt="" class="p-projectDetail__img">
                            @endif
                        </div>
                        <div class="p-projectDetail__postUserName">{{ optional($msg->sender)->name}}</div>
                        <div class="p-projectDetail__msg--left">{{ $msg->msg }}</div>
                    </div>
                    @elseif($msg->sender->id != $postProjects->post_user_id && $msg->sender->id != $user_id && $msg->project->id == $project_id)
                    <div class="p-projectDetail__msgPart--left">
                        @if($msg->sender->user_img)
                        <img src="{{ '/' . $msg->sender->user_img }}" alt="" class="p-projectDetail__img">
                        @else
                        <img src="{{ asset('img/person.jpg') }}" alt="" class="p-projectDetail__img">
                        @endif
                        <div class="p-projectDetail__applyUserName">{{ optional($msg->sender)->name}}</div>
                        <div class="p-projectDetail__msg--left">{{ $msg->msg }}</div>
                    </div>
                    @elseif($msg->sender->id == $user_id && $msg->sender->id == $user_id && $msg->project->id == $project_id)
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
            @if($postProjects->deleted_at == null)
            <div class="p-projectDetail__formContainer">
                <h1 class="p-projectDetail__title">メッセージを送る</h1>
                <form method="POSt" action="{{ route('send.msg', $postProjectID) }}" class="p-projectDetail__form">
                    @csrf
                    @method('put')
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
            @endif
        </div>
    </div>
</main>
@endsection

@include('read.footer')