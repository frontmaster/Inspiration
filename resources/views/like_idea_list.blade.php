@extends('layouts.master')

@section('title', '気になる一覧')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-likeIdeaList">
        @component('component.sidebar')
        @endcomponent

        <div class="p-likeIdeaList__content">
            <h1 class="p-likeIdeaList__title">気になるリスト一覧</h1>
        @if($likeIdeas->isEmpty())
            <p class="p-likeIdeaList__sentence">まだ気になるアイディアはありません</p>
        @else
            <likeidealist-component></likeidealist-component>
        @endif

        </div>
    </div>
</main>
@endsection

@include('layouts.footer')