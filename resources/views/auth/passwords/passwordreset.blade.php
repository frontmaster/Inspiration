@extends('layouts.master')

@section('title', 'パスワード再発行通知')

@section('header')
<header class="l-header">
        <div class="l-header__logo">Inspiration</div>
    </header>
@endsection

@section('content')
<main class="l-main">
    <div class="p-passReset">
        <div class="p-passReset__content">
            <h1 class="p-passReset__title">パスワードリセット</h1>
            <p>以下のボタンを押し、パスワードリセットの手続きを行ってください。</p>
            <div class="p-passReset__button">
                <a href="{{ $reset_url }}" class="c-btn p-passReset__btn">パスワードリセット</a>
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer')
@parent
@endsection