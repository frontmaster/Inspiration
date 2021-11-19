@extends('layouts.master')

@section('title', 'プロフィール編集')

@section('header')
@parent
@endsection

@section('content')
<div id="app">
    <main class="l-main">
        <div class="p-profile">
            <div class="l-sidebar p-profile__sidebar">
                <ul>
                    <h3 class="c-sidebar__menu--title">アイディアを購入したい方</h3>
                    <li class="c-sidebar__menu">
                        <a href="" class="c-sidebar__menu--link">アイディア一覧から探す</a>
                        <a href="" class="c-sidebar__menu--link">レビュー一覧から探す</a>
                        <a href="" class="c-sidebar__menu--link">気になる一覧から探す</a>
                    </li>

                    <h3 class="c-sidebar__menu--title">アイディアを投稿したい方</h3>
                    <li class="c-sidebar__menu--short">
                        <a href="" class="c-sidebar__menu--link">アイディアを投稿する</a>
                    </li>

                    <h3 class="c-sidebar__menu--title">アイディア一覧を見る</h3>
                    <li class="c-sidebar__menu--mid">
                        <a href="" class="c-sidebar__menu--link">投稿したアイディア一覧</a>
                        <a href="" class="c-sidebar__menu--link">購入したアイディア一覧</a>
                    </li>

                    <li class="c-sidebar__menu--short"><a href="{{ route('profile', auth()->user()->id) }}" class="c-sidebar__menu--link">プロフィール編集</a></li>
                </ul>
            </div>

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

                    <div class="p-profile__part--pass">
                        <label for="password" class="p-profile__label">パスワード</label>
                        <input type="password" class="p-profile__input @error('password') is-error @enderror" name="password" value="{{ $users->password }}" placeholder="半角英数" readonly>
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
</div>

@endsection

@section('footer')
@parent
@endsection