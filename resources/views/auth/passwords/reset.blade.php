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
                <input type="hidden" name="token" value="{{ $token }}">
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
                    <label for="new_password" class="p-passReset__label">新しいパスワード</label>
                    @error('new_password')
                    <span class="c-errMsg p-passReset__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                    <input type="password" class="p-passReset__input @error('new_password') is-error @enderror" name="new_password" value="{{ old('new_password') }}" placeholder="半角英数">
                </div>

                <div class="p-passReset__part">
                    <label for="confirm_password" class="p-passReset__label">新しいパスワード(確認)</label>
                    @error('confirm_password')
                    <span class="c-errMsg p-passReset__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                    <input type="password" class="p-passReset__input @error('confirm_password') is-error @enderror" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="半角英数">
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@include('layouts.footer')
