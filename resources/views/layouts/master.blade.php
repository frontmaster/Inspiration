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
</body>

</html>