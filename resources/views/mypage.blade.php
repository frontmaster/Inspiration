@extends('layouts.master')

@section('title', 'マイページ')

@section('header')
@parent
@endsection

@section('content')
<div id="app">
    <main class="l-main">

        <div class="p-mypage">
            <div class="l-sidebar">
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

            <div class="p-mypage__content">













            </div>
        </div>
    </main>
</div>

@endsection

@section('footer')
@parent
@endsection