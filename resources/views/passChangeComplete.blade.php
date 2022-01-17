@extends('layouts.master')

@section('title', 'パスワード変更完了')

@include('layouts.head')

@include('layouts.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-passChangeComplete">
            <p class="p-passChangeComplete__sentence">新しいパスワードへの変更が完了しました。引き続きInspirationをご利用ください</p>
            
    </div>

</main>
@endsection

@include('layouts.footer')