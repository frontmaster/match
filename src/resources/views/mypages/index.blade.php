@extends('layouts.master')

@section('title', 'マイページ')

@section('content')
<div class="p-mypage">
    @component('../components.sidebar')
    @endcomponent
    <div class="p-mypage__content">
        <h1 class="p-mypage__title">マイページ</h1>
        @if(session('success'))
        <div id="success-message" class="c-success">
            {{ session('success') }}
        </div>
        @endif
        <h2 class="p-mypage__subTitle">登録済み案件一覧</h2>
        <div id="app">
            
        </div>
    </div>

</div>
@endsection