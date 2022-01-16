@extends('layouts.master')

@section('title', 'パスワードリセット画面')

@include('layouts.head')

@include('layouts.header')

@section('content')
<main class="l-main">
    <div class="p-passReset">
        <div class="p-passReset__content">
            <h1 class="p-passReset__title">パスワードリセット</h1>
            <p class="p-passReset__sentence">下記の入力欄にメールアドレス、新しいパスワードを入力してください
            </p>
            <form method="POST" action="{{ route('password.update') }}" class="p-passReset__form">
                @csrf
                <div class="p-passReset__part">
                    <label for="email" class="p-passReset__label">メールアドレス</label>
                    @error('email')
                    <span class="c-errMsg p-passReset__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                    <input type="email" class="p-passReset__input @error('email') is-error @enderror" name="email" value="{{ old('email') }}" placeholder="半角英数">
                </div>

                <div class="p-passReset__part">
                    <label for="password" class="p-passReset__label">新しいパスワード</label>
                    @error('password')
                    <span class="c-errMsg p-passReset__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                    <input type="password" class="p-passReset__input @error('password') is-error @enderror" name="password" value="{{ old('password') }}" placeholder="半角英数">
                </div>

                <div class="p-passReset__part">
                    <label for="password" class="p-passReset__label">新しいパスワード(確認)</label>
                    @error('new_password')
                    <span class="c-errMsg p-passReset__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                    <input type="password" class="p-passReset__input @error('new_password') is-error @enderror" name="new_password" value="{{ old('new_password') }}" placeholder="半角英数">
                </div>

                <div class="p-passReset__button">
                    <button type="submit" class="c-btn p-passReset__btn">
                        送信
                    </button>
                </div>
            </form>
            <a href="{{ route('login')}}" class="p-passReset__link">ログイン画面へ戻る</a>
        </div>
    </div>
    </div>
</main>
@endsection
@include('layouts.footer')