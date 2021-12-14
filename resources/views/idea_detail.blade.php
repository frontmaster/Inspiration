@extends('layouts.master')

@section('title', 'アイディア詳細')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-ideaDetail">
        @component('component.sidebar')
        @endcomponent

        <div class="p-ideaDetail__content">
            <h1 class="p-ideaDetail__title">アイディア詳細</h1>
            <ideadetail-component></ideadetail-component>
            <div class="p-ideaDetail__button">
                <a href="https://twitter.com/intent/tweet?url=https://front-test.com/idea_detail/{{ $userIdea->id }}&text=簡単にアイディアを販売・購入できるアイディアマッチングサービス Inspiration" target="blank_" class="c-btn p-ideaDetail__button--share">
                    <i class="fab fa-twitter"></i>
                    シェアする
                </a>

                @if(!$already_liked)
                <p class="c-btn p-ideaDetail__btn js-like-word js-click-like" data-ideaid="{{ $userIdea->id }}">気になる</p>
                    <i class="fas fa-heart p-ideaDetail__heart js-like-heart"></i>
                @else
                <p class="c-btn p-ideaDetail__like js-unlike-word js-click-like" data-ideaid="{{ $userIdea->id }}">気になるを解除する</p>
                    <i class="fas fa-heart p-ideaDetail__heart--liked"></i>
                @endif
            </div>
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')