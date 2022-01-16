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
                    <label for="email" class="p-passEdit__label">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="p-passEdit__input @error('email') is-error @enderror" name="email" value="{{ $email ?? old('email') }}">
                </div>

                @error('new_password')
                        <span class="c-errMsg p-passEdit__errMsg">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                <div class="p-passEdit__part">
                    <label for="new_password" class="p-passEdit__label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
</main>
@endsection
@include('layouts.footer')