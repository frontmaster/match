@extends('layouts.master')

@section('title', '登録案件一覧')

@section('content')
<div class="p-mypage">
    <div class="p-mypage__sidebarContainer">
        @component('../components.sidebar')
        @endcomponent
    </div>
    <div class="p-mypage__content">
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