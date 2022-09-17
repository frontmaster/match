<!DOCTYPE html>
<html lang="ja">
@yield('read.head')

<body>
    @yield('read.header')

    <!-- フラッシュメッセージ -->
    @if(session('flash_message'))
    <div class="c-flashMsgContainer js-flashMsg">
        {{ session('flash_message') }}
    </div>
    @endif

    @yield('content')

    @yield('read.footer')

    @if(app('env') == 'local')
    <script src="{{ asset('/js/app.js') }}" defer></script>
    @endif
    @if(app('env') == 'production')
    <script src="{{ secure_asset('/js/app.js') }}" defer></script>
    @endif
</body>

</html>