@extends('layouts.master')

@section('title', 'アイディア一覧')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-ideaList">
        @component('component.sidebar')
        @endcomponent

        <div class="p-ideaList__content">
            <h1 class="p-ideaList__title">アイディア一覧</h1>
        @if($ideaLists->isEmpty())
            <p class="p-ideaList__sentence">まだアイディアはありません</p>
        @else
            <idealist-component :scores='{{ $scores }}'></idealist-component>
        @endif

        </div>
    </div>
</main>
@endsection

@include('layouts.footer')