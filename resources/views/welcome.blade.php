@extends('layouts.master')

@section('title', 'トップページ')

@section('header')
@parent
@endsection

@section('content')
<main class="l-main">
    <div class="p-top">
        <div class="p-top__imgContainer"><img src=" {{ asset('img/business.jpeg') }}" alt="" class="p-top__imgContainer--img">
            <p class="p-top__sentence">もっとシンプルに簡単に。</br>
                matchは簡単な手順でエンジニアと企業をつなぎます
            </p>
        </div>

        <div class="p-top__content">
            <h1 class="p-top__title">matchの特徴</h1>
            <div class="p-top__panelContent">
                <section class="p-top__panel">
                    <h2 class="p-top__panel--title">簡単に案件投稿ができる！</h2>
                    <p class="p-top__panel--sentence">
                        案件を投稿するのに色々な項目を入力する必要はありません。<br>
                        matchでは案件名、種別、金額、内容を入力するだけで、簡単に投稿できます。
                    </p>
                </section>

                <section class="p-top__panel">
                    <h2 class="p-top__panel--title">簡単に応募ができる！</h2>
                    <p class="p-top__panel--sentence">
                        案件の応募にも複雑な手順は必要ありません。<br>
                        matchではメールアドレスとパスワードで簡単にユーザー登録ができます。登録後は、
                        気になった案件に応募するだけです。
                    </p>
                </section>

                <section class="p-top__panel">
                    <h2 class="p-top__panel--title">簡単にやり取りができる！</h2>
                    <p class="p-top__panel--sentence">
                        案件応募後のやりとりも簡単です。<br>
                        案件に応募すると案件登録者に通知され、通知を受けて登録者とDM
                        で詳細なやり取りができます。
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