@extends('layouts.master')

@section('title', 'ユーザー登録ページ')

@section('header')
@parent
@endsection

@section('content')
<main class="l-main">
    <div class="p-register">
        <div class="p-register__content">
            <h1 class="p-register__title">ユーザー登録</h1>
            <form method="POST" action="{{ route('register') }}" class="p-register__form">
                @csrf

                <div class="p-register__part--name">
                    <label for="name" class="p-register__label">ニックネーム</label>
                    <input type="text" class="p-register__input @error('name') is-error @enderror" name="name" value="{{ Str::random(10) }}" readonly>
                </div>


                <div class="p-register__part">
                    <label for="email" class="p-register__label">メールアドレス
                        <span class="p-register__require">必須</span>
                    </label>
                    @error('email')
                    <span class="c-errMsg p-register__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror

                    <input type="email" class="p-register__input @error('email') is-error @enderror" name="email" value="{{ old('email') }}" placeholder="半角英数">
                </div>


                <div class="p-register__part">
                    <label for="password" class="p-register__label">パスワード
                        <span class="p-register__require">必須</span>
                    </label>
                    @error('password')
                    <span class="c-errMsg p-register__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror

                    <input type="password" class="p-register__input @error('password') is-error @enderror" name="password" placeholder="半角英数8文字以上">
                </div>


                <div class="p-register__part">
                    <label for="password-confirm" class="p-register__label">パスワード再入力
                        <span class="p-register__require">必須</span>
                    </label>
                    @error('password')
                    <span class="c-errMsg p-register__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror

                    <input type="password" class="p-register__input @error('password-confirm') is-error @enderror" name="password_confirmation">
                </div>
                <div class="p-register__button">
                    <button type="submit" class="c-btn p-register__btn">
                        登録
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('footer')
@parent
@endsection