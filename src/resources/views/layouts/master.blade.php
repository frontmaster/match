<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>@yield('title', 'match')</title>

    <!-- Styles & Scrips -->
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
</head>

<body class="l-body">
    @guest
    <header class="l-header">
        <div class="l-header__logo"><a href="{{ url('/') }}" class="l-header__logo--link">match</a></div>
        <div class="l-header__menuTrigger js-toggle-sp-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="l-header__nav js-toggle-sp-menu-target">
            <ul>
                <li class="l-header__menu"><a href="{{ url('/') }}" class="l-header__menu--link">TOP</a></li>
                <li class="l-header__menu"><a href="{{ route('login') }}" class="l-header__menu--link">ログイン</a></li>
                <li class="l-header__menu"><a href="{{ route('register') }}" class="l-header__menu--link">ユーザー登録 (無料)</a></li>
            </ul>
        </nav>
    </header>
    @else
    <header class="l-header">
        <div class="l-header__logo"><a href="" class="l-header__logo--link">match</a></div>

        <div class="l-header__menuTrigger js-toggle-sp-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="l-header__nav js-toggle-sp-menu-target">
            <ul>
                <li class="l-header__menu"><a href="{{ route('mypages.index') }}" class="l-header__menu--link">マイページ</a></li>
                <li class="l-header__menu"><a href="{{ route('logout') }}" class="l-header__menu--link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">ログアウト</a></li>
                <li class="l-header__menu"><a href="" class="l-header__menu--link">退会する</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </ul>
        </nav>
    </header>
    @endguest
    <main class="l-main">
        @yield('content')
    </main>

    <footer class="l-footer">
        <div class="l-footer__container">Copyright © match All Rights Reserved.</div>
    </footer>
</body>

</html>