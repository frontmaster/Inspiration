@extends('layouts.master')

@section('title', 'メール')

@include('layouts.head')

@section('content')
<div id="app">
    <main class="l-main" id="app">
        <div class="p-mail">
            <p>{{ $sale_user->name}}さんのアイディアを購入しました</p>
        </div>
</div>
</main>
</div>

@endsection