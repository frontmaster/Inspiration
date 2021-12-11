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
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')