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
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                @error('email')
                <span class="c-errMsg p-passEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-passEdit__part">
                    <label for="email" class="p-passEdit__label">メールアドレス</label>
                    <input id="email" type="email" class="p-passEdit__input @error('email') is-error @enderror" name="email" value="{{ $email ?? old('email') }}">
                </div>

                @error('new_password')
                <span class="c-errMsg p-passEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-passEdit__part">
                    <label for="new_password" class="p-passEdit__label">新しいパスワード</label>
                    <input id="password" type="password" class="p-passEdit__input @error('password') is-error @enderror" name="password" required autocomplete="new-password">
                </div>

                <div class="p-passEdit__part">
                    <label for="password-confirm" class="p-passEdit__label">新しいパスワード(確認)</label>
                    <input id="password-confirm" type="password" class="p-passEdit__input" name="password_confirmation" required autocomplete="new-password">
                </div>


                <div class="p-passEdit__button">
                    <button type="submit" class="c-btn p-passEdit__btn">
                        送信
                    </button>
                </div>

            </form>

        </div>
    </div>
    </div>
</main>
@endsection
@include('layouts.footer')