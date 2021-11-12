<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- Styles & Scrips -->
    @if(app('env') == 'local')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    @endif
    @if(app('env') == 'production')
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @endif

</head>

<body>
    @section('header')
    @guest
    <header class="l-header">
        <div class="l-header__logo"><a href="{{ url('/') }}" class="l-header__logo--link">Inspiration</a></div>
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
        <div class="l-header__logo"><a href="{{ url('/') }}" class="l-header__logo--link">Inspiration</a></div>

        <div class="l-header__menuTrigger js-toggle-sp-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="l-header__nav js-toggle-sp-menu-target">
            <ul>
                <li class="l-header__menu"><a href="{{ url('/') }}" class="l-header__menu--link">TOP</a></li>
                <li class="l-header__menu"><a href="{{ route('mypage', auth()->user()->id) }}" class="l-header__menu--link">マイページ</a></li>
                <li class="l-header__menu"><a href="{{ route('logout') }}" class="l-header__menu--link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">ログアウト</a></li>
                <li class="l-header__menu"><a href="{{ route('users.delete_confirm', auth()->user()->id) }}" class="l-header__menu--link">退会する</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </ul>
        </nav>
    </header>
    @endguest
    @show

    <!-- フラッシュメッセージ -->
    @if(session('flash_message'))
    <div class="c-flashMsgContainer js-flashMsg">
        {{ session('flash_message') }}
    </div>
    @endif

    @yield('content')

    @section('footer')
    <footer class="l-footer">
        <div class="l-footer__container">Copyright © Inspiration All Rights Reserved.</div>
    </footer>
    @show

</body>

</html>