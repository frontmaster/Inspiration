@extends('layouts.master')

@section('title', 'WEBサービスのアイディアマッチングサイト | Inspiration')

@include('layouts.head')

@include('layouts.header')

@section('content')
<main class="l-main" id="app">
    @if(session('flash_message'))
    <div class="c-flashMsgContainer js-flashMsg">
        {{ session('flash_message') }}
    </div>
    @endif
    <div class="p-top">
        <div class="p-top__imgContainer">
            <p class="p-top__sentence">簡単にアイディアを販売・購入できる</br>
                WEBサービスのアイディアマッチングサービス
            </p>
            <img src=" {{ asset('img/business-1.jpg') }}" alt="" class="p-top__imgContainer--img">
        </div>

        <div class="p-top__content">
            <h1 class="p-top__title">ABOUT</h1>
            <div class="p-top__contentBody">
                <p class="p-top__contentSentence">IdeaBridgeは、優れたアイディアと円滑な開発とのギャップを埋めるサービスです。<br>
                    素晴らしいアイディアはあるけれども、それを具現化するのに苦労していませんか？あるいは、技術的な専門知識はあるけれども、
                    魅力的なアイディアが無くてお困りではありませんか？IdeaBridgeでは、アイディア提供者と開発者をマッチングし、より良いサービスを生む
                    ことを目的としています。<br>
                    革新的なアイディアは世界を変える力を秘めています。しかし、アイディアが形になることができないのは非常にもったいないことです。IdeaBridgeは、
                    そんな優れたアイディアを持つ人々と、それを具現化するスキルと情熱を持つ人々を繋げ、新しい可能性を拓くことを使命としています。<br>
                    IdeaBridgeでアイディアと実現の新しい旅に出発しましょう。未知の可能性を探究し、イノベーションの世界への扉を開きましょう。
                </p>
            </div>
        </div>

        <div class="p-top__content--feature">
            <h1 class="p-top__title">IdeaBridgeの特徴</h1>
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
                        きちんと購入できた事がわかるようになっています。<br>
                        また、5段階評価・口コミが投稿されると、アイディア販売者にメールでお知らせします。
                    </p>
                </section>
            </div>
        </div>
        <div class="p-top__itemContent">
            @if(isset($postIdeaLists[0]))
            <h1 class="p-top__title">新着のアイディア</h1>
            @else
            <h1 class="p-top__title--notpost">まだ新着のアイディアはありません</h1>
            @endif
            <div class="p-top__itemContainer">
                @foreach($postIdeaLists as $postIdeaList)
                <div class="p-top__item">
                    <label for="idea" class="p-top__label">アイディア名</label>
                    <p class="p-top__item--part">{{ $postIdeaList->idea_name }}</p>
                    <label for="category" class="p-top__label">カテゴリ</label>
                    <p class="p-top__item--part">{{ $postIdeaList->category->category_name }}</p>
                    <div class="p-top__item--footer">
                        <div class="p-top__item--price">
                            <label for="price" class="p-top__label">価格</label>
                            <p class="p-top__item--part">¥{{ number_format($postIdeaList->price) }}</p>
                        </div>
                        <a href="{{ route('idea_detail', $postIdeaList->id) }}" class="c-btn p-top__btn">詳細を見る</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection

@include('layouts.footer')