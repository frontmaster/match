@extends('layouts.master')

@section('title', 'マイページ')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-mypage">

        <div class="p-mypage__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>

        <div class="p-mypage__content">
            <div class="p-mypage__itemList">
                <h1 class="p-mypage__title">登録案件一覧</h1>
                @if($postProjects->isEmpty())
                <p class="p-mypage__sentence">まだ登録した案件はありません</p>
                @else
                <div class="p-mypage__itemBox">
                    @foreach($postProjects as $project)
                    <div class="p-mypage__itemContainer">
                        <div class="p-mypage__item">
                            <label for="project" class="p-mypage__label">案件名</label>
                            <p class="p-mypage__item--part">{{ $project->title }}</p>
                        </div>
                        <div class="p-mypage__item">
                            <label for="category" class="p-mypage__label">案件種別</label>
                            <p class="mypage__item--part">{{ $project->category->category_name }}</p>
                        </div>

                        <div class="p-mypage__item--price">
                            <label for="price" class="p-mypage__label">金額</label>
                            @if($project->category_id == 1)
                            <div class="p-mypage__priceContainer">
                                <p class="mypage__item--part">{{ $project->low_price }}千円</p>
                                <span class="p-mypage__tilde">~</span>
                                <p class="mypage__item--part">{{ $project->high_price }}千円</p>
                            </div>
                            @elseif($project->category_id == 2)
                            <p class="p-mypage__sentence--price">売り上げに応じて変動</p>
                            @endif
                        </div>
                        <a href="{{ route('post.project.detail', $project->id) }}" class="c-btn p-mypage__btn">詳細</a>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('post.projectList.show', auth()->user()->id) }}" class="p-mypage__link">全件表示する</a>
                @endif

            </div>

            <div class="p-mypage__itemList">
                <h1 class="p-mypage__title">応募案件一覧</h1>
                @if($applyProjects->isEmpty())
                <p class="p-mypage__sentence">まだ応募した案件はありません</p>
                @else
                <div class="p-mypage__itemBox">
                    @foreach($applyProjects as $project)
                    <div class="p-mypage__itemContainer">
                        <div class="p-mypage__item">
                            <label for="project" class="p-mypage__label">案件名</label>
                            <p class="p-mypage__item--part">{{ $project->title }}</p>
                        </div>
                        <div class="p-mypage__item">
                            <label for="category" class="p-mypage__label">案件種別</label>
                            <p class="p-mypage__item--part">{{ $project->category->category_name }}</p>
                        </div>

                        <div class="p-mypage__item--price">
                            <label for="price" class="p-mypage__label">金額</label>
                            @if($project->category_id == 1)
                            <p class="mypage__item--part">{{ $project->low_price }}</p>
                            <span class="p-mypage__tilde">~</span>
                            <p class="mypage__item--part">{{ $project->high_price }}</p>
                            @elseif($project->category_id == 2)
                            <p class="p-mypage__sentence--price">売り上げに応じて変動</p>
                            @endif
                        </div>
                        <a href="{{ route('post.project.detail', $applyProject->project_id) }}" class="c-btn p-mypage__btn">詳細</a>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('apply.projectList.show', auth()->user()->id) }}" class="p-mypage__link">全件表示する</a>
                @endif
            </div>
            <div class="p-mypage__itemList">
                <h1 class="p-mypage__title">パブリックメッセージ一覧</h1>
                @if($publicMessages == null)
                <p class="p-mypage__sentence">まだパブリックメッセージはありません</p>
                @else
                <div class="p-mypage__itemBox--msg">
                    <div class="p-mypage__itemContainer--msg">
                        <div class="p-mypage__item--msg">
                            <label for="project" class="p-mypage__label">案件名</label>
                            <p class="p-mypage__item--part">{{ $publicMessages->project->title }}</p>
                        </div>
                        <div class="p-mypage__item--msg">
                            <label for="category" class="p-mypage__label">案件種別</label>
                            <p class="p-mypage__item--part">{{ $publicMessages->project->category->category_name }}</p>
                        </div>
                        <div class="p-mypage__item--msg">
                            <label for="price" class="p-mypage__label">金額</label>
                            @if($publicMessages->project->category_id == 1)
                            <p class="p-mypage__item--part">{{ $publicMessages->project->low_price }}</p>
                            <p class="p-mypage__tilde">~</p>
                            <p class="p-mypage__item--part">{{ $publicMessages->project->high_price }}</p>
                            @elseif($publicMessages->project->category_id == 2)
                            <p class="p-mypage__sentence--price">売り上げに応じて変動</p>
                            @endif
                        </div>
                        <a href="{{ route('post.project.detail', $publicMessages->project->id) }}" class="c-btn p-mypage__btn">詳細</a>
                    </div>
                    <div class="p-mypage__msgPart--right">
                        <div class="p-mypage__msg--right">{{ optional($publicMessages)->msg }}</div>
                    </div>
                </div>
                @endif
            </div>


            <div class="p-mypage__itemList">
                <h1 class="p-mypage__title">ダイレクトメッセージ一覧</h1>
                @if($applyProject == null)
                <p class="p-mypage__sentence">まだダイレクトメッセージはありません</p>
                @else
                <div class="p-mypage__itemBox--msg">
                    @if(optional($applyProject)->post_user_id == auth()->user()->id)
                    <div class="p-mypage__projectCategory">応募があった案件</div>
                    @elseif(optional($applyProject)->apply_user_id == auth()->user()->id)
                    <div class="p-mypage__projectCategory">あなたが応募した案件</div>
                    @endif
                    <div class="p-mypage__itemContainer--msg">
                        <div class="p-mypage__item--msg">
                            <label for="project" class="p-mypage__label">案件名</label>
                            <p class="p-mypage__item--part">{{ optional($applyProject->postProject)->title }}</p>
                        </div>
                        <div class="p-mypage__item--msg">
                            <label for="category" class="p-mypage__label">案件種別</label>
                            <p class="p-mypage__item--part">{{ optional($applyProject)->postProject->category->category_name }}</p>
                        </div>
                        <div class="p-mypage__item--msg">
                            <label for="price" class="p-mypage__label">金額</label>
                            @if(optional($applyProject)->postProject->category_id == 1)
                            <p class="p-mypage__item--part">{{ optional($applyProject)->postProject->low_price }}</p>
                            <p class="p-mypage__tilde">~</p>
                            <p class="p-mypage__item--part">{{ optional($applyProject)->postProject->high_price }}</p>
                            @elseif(optional($applyProject)->postProject->category_id == 2)
                            <p class="p-mypage__sentence--price">売り上げに応じて変動</p>
                            @endif
                        </div>
                        <a href="{{ route('post.project.detail', $applyProject->project_id) }}" class="c-btn p-mypage__btn">詳細</a>
                    </div>
                    @if($directMessages && auth()->user()->id == optional($directMessages)->sender_id)

                    <div class="p-mypage__msgPart--right">
                        <div class="p-mypage__msg--right">{{ optional($directMessages)->msg }}</div>
                    </div>

                    @elseif($directMessages && auth()->user()->id != optional($directMessages)->sender_id)

                    <div class="p-mypage__msgPart--left">
                        <div class="p-mypage__applyUserInfo">
                            @if($applyUserImg && auth()->user()->id != optional($directMessages)->sender_id)
                            <img src="{{'/' . $applyUserImg }}" alt="" class="p-mypage__img">
                            @elseif($postUserImg && auth()->user()->id == optional($directMessages)->sender_id)
                            <img src="{{'/' . $postUserImg }}" alt="" class="p-mypage__img">
                            @else
                            <img src="{{ asset('img/person.jpg') }}" alt="" class="p-mypage__img">
                            @endif
                            @if(optional($directMessages)->sender_id == optional($directMessages)->apply_user_id)
                            <div class="p-mypage__applyUserName">{{ $applyProject->applyUser->name }}</div>
                            @elseif(optional($directMessages)->sender_id == $directMessages->post_user_id)
                            <div class="p-mypage__applyUserName">{{ $applyProject->postUser->name }}</div>
                            @endif
                        </div>
                        <div class="p-mypage__msg--left">{{ optional($directMessages)->msg }}</div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

@include('read.footer')