@extends('layouts.master')

@section('title', '投稿案件一覧')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-postProjectList">
        <div class="p-postProjectList__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>
        <div class="p-postProjectList__content">
            <h1 class="p-postProjectList__title">登録案件一覧</h1>
            @if($postProjects == null)
            <p class="p-postProjectList__sentence">まだ投稿した案件はありません</p>
            @else
            <postprojectlist-component></postprojectlist-component>
            @endif
        </div>
    </div>
</main>
@endsection

@include('read.footer')