@extends('layouts.master')

@section('title', 'アイディア詳細')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-ideaDetail">
        @component('component.sidebar')
        @endcomponent

        <div class="p-ideaDetail__content">
            <h1 class="p-ideaDetail__title">アイディア詳細</h1>
            <div class="p-ideaDetail__Container">
                <div class="p-ideaDetail__partContainer">
                    <div class="p-ideaDetail__part">
                        <div class="p-ideaDetail__postUser">
                            <label for="postUser" class="p-ideaDetail__label">アイディア投稿者</label>
                            <div class="p-ideaDetail__postUserInfo">
                                @if($postIdeaUser->user_img == null)
                                <img src="/img/person.jpg" alt="" class="c-img p-ideaDetail__img"/>
                                @else
                                <img src="{{'/' . $postIdeaUser->user_img}}" alt="" class="c-img p-ideaDetail__img"/>
                                @endif
                                <p class="p-ideaDetail__postUserInfo--name">{{ $postIdeaUser->name }}</p>
                            </div>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="idea" class="p-ideaDetail__label">アイディア名</label>
                            <p class="p-ideaDetail__item--part">{{ $ideaDetail->idea_name }}</p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="category" class="p-ideaDetail__label">カテゴリ</label>
                            <p class="p-ideaDetail__item--part">
                                {{ $category->category_name }}
                            </p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="summary" class="p-ideaDetail__label">概要</label>
                            <p class="p-ideaDetail__item--part">{{ $ideaDetail->summary }}</p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="content" class="p-ideaDetail__label">内容</label>
                            <p class="p-ideaDetail__item--part">購入後に表示されます</p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="idea" class="p-ideaDetail__label">価格</label>
                            <p class="p-ideaDetail__item--part">¥{{ number_format($ideaDetail->price) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-ideaDetail__button">
                <a href="https://twitter.com/intent/tweet?url=https://front-test.com/idea_detail/{{ $userIdea->id }}&text=簡単にアイディアを販売・購入できるアイディアマッチングサービス Inspiration" target="blank_" class="c-btn p-ideaDetail__button--share">
                    <i class="fab fa-twitter"></i>
                    シェアする
                </a>

                @if(!$already_liked)
                <p class="c-btn p-ideaDetail__btn js-like-word js-click-like" data-ideaid="{{ $userIdea->id }}">気になる</p>
                <i class="fas fa-heart p-ideaDetail__heart js-like-heart"></i>
                @else
                <p class="c-btn p-ideaDetail__btn likebtn js-unlike-word js-click-like" data-ideaid="{{ $userIdea->id }}">気になるを解除する</p>
                <i class="fas fa-heart p-ideaDetail__heart js-like-heart likeheart"></i>
                @endif
            </div>
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')