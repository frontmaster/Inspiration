@extends('layouts.master')

@section('title', '投稿したアイディア一覧')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-postIdeaList">
        @component('component.sidebar')
        @endcomponent

        <div class="p-postIdeaList__content">
            <h1 class="p-postIdeaList__title">投稿したアイディア一覧</h1>
            <postidealist-component></postidealist-component>
        </div>
    </div>
</main>
@endsection

@include('layouts.footer')