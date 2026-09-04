@extends('layouts.master')

@section('title', 'アイディア一覧')

@section('content')
<div class="p-mypage">
    <div class="p-mypage__sidebarContainer">
        @component('../components.sidebar')
        @endcomponent
    </div>

    <div class="p-mypage__content">
        <div id="app" data-page="projects"></div>
    </div>
</div>
@endsection