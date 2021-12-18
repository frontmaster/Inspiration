@extends('layouts.master')

@section('title', '気になる一覧')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-postIdeaList">
        @component('component.sidebar')
        @endcomponent

        <div class="p-postIdeaList__content">
            <h1 class="p-postIdeaList__title">気になる一覧</h1>
        @if($likeIdeas == null)
            <p class="p-postIdeaList__sentence">気になる一覧はありません</p>
        @else
            <likeidealist-component></likeidealist-component>
        @endif

        </div>
    </div>
</main>
@endsection

@include('layouts.footer')