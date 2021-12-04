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
            
                <a href="{{ route('profile', auth()->user()->id) }}" class="c-btn p-mypage__btn">プロフィールを編集する</a>
            

            <div class="p-mypage__content">













            </div>
        </div>
    </main>
</div>

@endsection

@include('layouts.footer')