@extends('layouts.master')

@section('title', 'マイページ')

@include('layouts.head')

@include('layouts.header')

@section('content')
<div id="app">
    <main class="l-main" id="app">
        <div class="p-mypage">
            @component('component.sidebar')
            @endcomponent
            <button class="c-btn p-mypage__btn">
                <a href="{{ route('profile', auth()->user()->id) }}" class="p-mypage__btn--link">プロフィールを編集する</a>
            </button>

            <div class="p-mypage__content">













            </div>
        </div>
    </main>
</div>

@endsection

@include('layouts.footer')