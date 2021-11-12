@extends('layouts.master')

@section('title', 'トップページ')

@section('header')
@parent
@endsection

@section('content')
<main class="l-main">
    <div class="p-deleteconfirm">
        <h3 class="p-deleteconfirm__title">退会の確認</h3>
        <div class="p-deleteconfirm__content">
            <p class="p-deleteconfirm__content--sentence">退会すると登録したすべてのデータが失われます。宜しいですか？</p>
        </div>
        <form action="{{ route('deleteUsers', auth()->user()->id)}}" method="post" class="p-deleteconfirm__form">
            @csrf
            <button type="submit" class="c-btn p-deleteconfirm__btn">退会する</button>
        </form>
    </div>
</main>
@endsection

@section('footer')
@parent
@endsection