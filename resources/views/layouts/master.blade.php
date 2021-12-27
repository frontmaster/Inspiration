<!DOCTYPE html>
<html lang="ja">

@yield('head')

<body>
    @yield('header')
    
    <!-- フラッシュメッセージ -->
    @if(session('flash_message'))
    <div class="c-flashMsgContainer js-flashMsg">
        {{ session('flash_message') }}
    </div>
    @endif

    @yield('content')
    
    @yield('footer')
    
    @if(app('env') == 'local')
    <script src="{{ mix('js/app.js') }}" defer></script>
    @endif
    @if(app('env') == 'production')
    <script src="{{ mix('js/app.js') }}" defer></script>
    @endif
</body>

</html>