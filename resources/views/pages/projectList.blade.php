@extends('layouts.master')

@section('title', '案件一覧')

@include('read.head')

@include('read.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-projectList">
        <div class="p-projectList__sidebarContainer">
            @component('component.sidebar')
            @endcomponent
        </div>
        <div class="p-projectList__content">
            <h1 class="p-projectList__title">案件一覧</h1>
            <projectlist-component></projectlist-component>
        </div>
    </div>
</main>
@endsection

@include('read.footer')