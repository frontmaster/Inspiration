@extends('layouts.master')

@section('title', 'WEBサービスのアイディアマッチングサイト | Inspiration')

@section('header')
@parent
@endsection

@section('content')
<main class="l-main">
    <div class="p-top">
        <div class="p-top__imgContainer">
            <p class="p-top__sentence">簡単にアイディアを販売・購入できる</br>
                WEBサービスのアイディアマッチングサービス
            </p>
            <img src=" {{ asset('img/business-1.jpg') }}" alt="" class="p-top__imgContainer--img">
        </div>

        <div class="p-top__content">
            <h1 class="p-top__title">Inspirationの特徴</h1>
            <div class="p-top__panelContent">
                <section class="p-top__panel">
                    <h2 class="p-top__panel--title">簡単にユーザー登録ができる！</h2>
                    <img src=" {{ asset('img/business-2.jpg') }}" alt="" class="p-top__panel--img">
                    <p class="p-top__panel--sentence">
                        ユーザー登録に時間はかかりません。メールアドレス、パスワードだけで簡単にユーザー登録ができます。
                    </p>
                </section>

                <section class="p-top__panel">
                    <h2 class="p-top__panel--title">評価・口コミができる！</h2>
                    
                    <img src=" {{ asset('img/business-4.jpg') }}" alt="" class="p-top__panel--img">
                    
                    <p class="p-top__panel--sentence">
                        購入者はアイディアに対して5段階評価・口コミを投稿することができます。<br>
                        購入前の参考に5段階評価・口コミをご覧ください。
                    </p>
                </section>

                <section class="p-top__panel">
                    <h2 class="p-top__panel--title">メールでお知らせ！</h2>
                    <img src=" {{ asset('img/business-3.jpg') }}" alt="" class="p-top__panel--img">
                    <p class="p-top__panel--sentence">
                        アイディアを購入するとアイディア販売者と購入者にメールが送信され、自分のアイディアが購入された事、
                        きちんと購入できたことがわかるようになっています。<br>
                        また、5段階評価・口コミが投稿されると、アイディア販売者にメールでお知らせします。
                    </p>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection

@section('footer')
@parent
@endsection