@extends('layouts.master')

@section('title', 'レビュー一覧')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-reviewList">
        @component('component.sidebar')
        @endcomponent

        <div class="p-reviewList__content">
            <h1 class="p-reviewList__title">レビュー一覧</h1>
            @if($reviews->isEmpty())
            <p class="p-reviewList__sentence">レビューはありません</p>
            @else
            <reviewlist-component></reviewlist-component>
            @endif

        </div>
    </div>
</main>
@endsection

@include('layouts.footer')