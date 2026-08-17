@extends('layouts.master')

@section('title', 'マイページ')

@section('body-class', 'is-mypage')

@section('content')
<div class="p-mypage">
    <div class="p-mypage__sidebarContainer">
        @component('../components.sidebar')
        @endcomponent
    </div>
    <div class="p-mypage__content">
        <h1 class="p-mypage__title">マイページ</h1>
        @if(session('success'))
        <div id="success-message" class="c-success">
            {{ session('success') }}
        </div>
        @endif
        <div id="app" data-page="mypage-projects">

        </div>
    </div>

</div>
@endsection