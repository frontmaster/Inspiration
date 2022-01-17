@extends('layouts.master')

@section('title', 'パスワード変更')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-passEdit">
        @component('component.sidebar')
        @endcomponent
        
        <div class="p-passEdit__content">
            <h1 class="p-passEdit__title">パスワード変更</h1>
            <form method="POST" action="{{ route('password.change', $users->id) }}" enctype="multipart/form-data" class="p-passEdit__form">
                @csrf
                
                @error('old_password')
                <span class="c-errMsg p-passEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-passEdit__part">
                    <label for="password" class="p-passEdit__label">現在のパスワード</label>
                    <input type="password" class="p-passEdit__input @error('old_password') is-error @enderror" name="old_password">
                </div>

                @error('new_password')
                <span class="c-errMsg p-passEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-passEdit__part">
                    <label for="password" class="p-passEdit__label">新しいパスワード</label>
                    <input type="password" class="p-passEdit__input @error('new_password') is-error @enderror" name="new_password">
                </div>

                @error('new_password_confirmation')
                <span class="c-errMsg p-passEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-passEdit__part">
                    <label for="password" class="p-passEdit__label">新しいパスワード(再入力)</label>
                    <input type="password" class="p-passEdit__input @error('new_password_confirmation') is-error @enderror" name="new_password_confirmation">
                </div>

                
                <div class="p-passEdit__button">
                    <button type="submit" class="c-btn p-passEdit__btn">
                        変更する
                    </button>
                </div>
                <p><a class="p-passEdit__returnMsg" href="{{ route('profile', auth()->user()->id) }}">プロフィール編集画面へ戻る</a></p>
            </form>
        </div>
    </div>
</main>
@endsection

@include('layouts.footer')