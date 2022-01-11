@extends('layouts.master')

@section('title', '購入したアイディア一覧')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-ideaList">
        @component('component.sidebar')
        @endcomponent
        <div class="p-ideaList__content">
            <h1 class="p-ideaList__title">購入したアイディア一覧</h1>
            @if($boughtIdeaLists == null)
            <p class="p-ideaList__sentence">まだ購入したアイディアはありません</p>
            @else
            <boughtidealist-component></boughtidealist-component>
            @endif
        </div>
    </div>
</main>
@endsection

@include('layouts.footer')