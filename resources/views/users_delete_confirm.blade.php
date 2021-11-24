@extends('layouts.master')

@section('title', '退会手続き')

@include('layouts.head')

@include('layouts.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-deleteconfirm">
    <div class="p-deleteconfirm__content">
        <h3 class="p-deleteconfirm__title">退会手続き</h3>
        
            <p class="p-deleteconfirm__content--sentence">退会すると登録したすべてのデータが失われます。宜しいですか？</p>

            <form action="{{ route('deleteUsers', auth()->user()->id)}}" method="post" class="p-deleteconfirm__form">
                @csrf
                <button type="submit" class="c-btn p-deleteconfirm__btn">退会する</button>
            </form>
        </div>
    </div>
</main>
@endsection

@include('layouts.footer')