@extends('layouts.master')

@section('title', 'エラー画面')

@include('layouts.head')

@include('layouts.header')

@section('content')
<main class="l-main">
    <div class="p-error">
        <div class="p-error__content">
            <p class="p-error__sentence">このID番号のアイディアは存在しません</p>
        </div>
    </div>
</main>
@endsection

@include('layouts.footer')