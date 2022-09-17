@section('read.header')
@guest
<header class="l-header">
    <div class="l-header__logo"><a href="{{ url('/') }}" class="l-header__logo--link">match</a></a></div>
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
    <div class="l-header__logo"><a href="{{ route('mypage', auth()->user()->id) }}" class="l-header__logo--link">match</a></div>

    <div class="l-header__menuTrigger js-toggle-sp-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav class="l-header__nav js-toggle-sp-menu-target">
        <ul>
            <li class="l-header__menu"><a href="{{ route('mypage', auth()->user()->id) }}" class="l-header__menu--link">マイページ</a></li>
            <li class="l-header__menu"><a href="{{ route('logout') }}" class="l-header__menu--link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">ログアウト</a></li>
            <li class="l-header__menu"><a href="{{ route('users.delete_confirm', auth()->user()->id )}}" class="l-header__menu--link">退会する</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </ul>
    </nav>
</header>
@endguest
@endsection