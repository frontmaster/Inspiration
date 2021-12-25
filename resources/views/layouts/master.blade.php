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
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    @if(app('env') == 'production')
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    <script src="{{ secure_asset('https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js')}}"></script>
    @endif
</body>

</html>