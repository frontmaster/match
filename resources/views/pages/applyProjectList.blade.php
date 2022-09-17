@extends('layouts.master')

@section('title', '応募案件一覧')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-applyProjectList">
        <div class="p-applyProjectList__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>
        <div class="p-applyProjectList__content">
            <h1 class="p-applyProjectList__title">応募案件一覧</h1>
            @if($applyProject == null)
            <p class="p-applyProjectList__sentence">まだ応募した案件はありません</p>
            @else
            <applyprojectlist-component></applyprojectlist-component>
            @endif
        </div>

    </div>
</main>
@endsection

@include('read.footer')