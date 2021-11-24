@extends('layouts.master')

@section('title', 'プロフィール編集')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-profile">
        @component('component.sidebar')
        @endcomponent

        <div class="p-profile__content">
            <h1 class="p-profile__title">プロフィール編集</h1>
            <form method="POST" action="{{ route('store',$users->id) }}" enctype="multipart/form-data" class="p-profile__form">
                @csrf
                @error('user_img')
                <span class="c-errMsg p-profile__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-profile__part">
                    <label for="img" class="p-profile__label">プロフィール画像</label>
                    <div class="p-profile__imgContainer">
                        @if($users->user_img === null)
                        <img src="{{ asset('img/person.jpg') }}" alt="" class="c-img p-profile__img">
                        @else
                        <img src="{{ Storage::url($users->user_img) }}" class="c-img p-profile__img" alt="">
                        @endif
                        <label class="p-profile__inputarea">
                            <input type="file" class="p-profile__input--img @error('img') is-error @enderror" name="user_img">
                            画像ファイルを選択する
                        </label>
                    </div>
                </div>

                @error('name')
                <span class="c-errMsg p-profile__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-profile__part--name">
                    <label for="name" class="p-profile__label">ニックネーム</label>
                    <input type="text" id="count-name" class="p-profile__input @error('name') is-error @enderror" name="name" value="{{ $users->name }}" placeholder="半角英数字20文字以内で入力してください">
                    <div class="p-profile__countarea">
                        <span class="c-countarea js-show-count" id="count">0</span>/20
                    </div>
                </div>


                @error('email')
                <span class="c-errMsg p-profile__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-profile__part">
                    <label for="email" class="p-profile__label">メールアドレス</label>
                    <input type="email" class="p-profile__input @error('email') is-error @enderror" name="email" value="{{ $users->email }}" placeholder="半角英数">
                </div>

                <div class="p-profile__part">
                    <p><a class="p-profile__link" href="{{ url('password/change', auth()->user()->id) }}">パスワードを変更する方はコチラ</a></p>
                </div>

                @error('comment')
                <span class="c-errMsg p-profile__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-profile__part">
                    <label for="content" class="p-profile__label">自己紹介</label>
                    <textarea id="count-comment" name="comment" class="p-profile__textarea">{{ $users->comment }}</textarea>
                    <div class="p-profile__countarea--comment">
                        <span class="c-countarea js-show-count-comment">0</span>/10000
                    </div>
                </div>

                <div class="p-profile__button">
                    <button type="submit" class="c-btn p-profile__btn">
                        変更する
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@include('layouts.footer')