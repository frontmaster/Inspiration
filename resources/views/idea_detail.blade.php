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
            <div class="p-ideaDetail__Container">
            <h1 class="p-ideaDetail__title">アイディア詳細</h1>
                <div class="p-ideaDetail__partContainer">
                    <div class="p-ideaDetail__part">
                        <div class="p-ideaDetail__postUser">
                            <label for="postUser" class="p-ideaDetail__label">アイディア投稿者</label>
                            <div class="p-ideaDetail__postUserInfo">
                                @if($postIdeaUser->user_img == null)
                                <img src="/img/person.jpg" alt="" class="c-img p-ideaDetail__img" />
                                @else
                                <img src="{{'/' . $postIdeaUser->user_img}}" alt="" class="c-img p-ideaDetail__img" />
                                @endif
                                <p class="p-ideaDetail__postUserInfo--name">{{ $postIdeaUser->name }}</p>
                            </div>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="idea" class="p-ideaDetail__label">アイディア名</label>
                            <p class="p-ideaDetail__item--part">{{ $postidea->idea_name }}</p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="category" class="p-ideaDetail__label">カテゴリ</label>
                            <p class="p-ideaDetail__item--part">
                                {{ $category->category_name }}
                            </p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="summary" class="p-ideaDetail__label">概要</label>
                            <p class="p-ideaDetail__item--part">{{ $postidea->summary }}</p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="content" class="p-ideaDetail__label">内容</label>
                            @if($buy_user_id != auth()->user()->id)
                            <p class="p-ideaDetail__item--part">購入後に表示されます</p>
                            @else
                            <p class="p-ideaDetail__item--part">{{ $postidea->content }}</p>
                            @endif
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="idea" class="p-ideaDetail__label">価格</label>
                            <p class="p-ideaDetail__item--part">¥{{ number_format($postidea->price) }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-ideaDetail__button">
                    <a href="https://twitter.com/intent/tweet?url=https://front-test.com/idea_detail/{{ $idea_id }}&text=簡単にアイディアを販売・購入できるアイディアマッチングサービス Inspiration" target="blank_" class="c-btn p-ideaDetail__button--share">
                        <i class="fab fa-twitter"></i>
                        シェアする
                    </a>

                    @if(!$already_liked)
                    <p class="c-btn p-ideaDetail__btn--like js-like-word js-click-like" data-ideaid="{{ $idea_id }}">気になる</p>
                    <i class="fas fa-heart p-ideaDetail__heart js-like-heart"></i>
                    @else
                    <p class="c-btn p-ideaDetail__btn--unlike likebtn js-unlike-word js-click-like" data-ideaid="{{ $idea_id }}">気になるを解除する</p>
                    <i class="fas fa-heart p-ideaDetail__heart js-like-heart likeheart"></i>
                    @endif
                </div>
            </div>


            <div class="p-ideaDetail__formContainer">
                <form class="p-ideaDetail__form" action="{{ route('idea_buy', $postidea->id) }}" method="POST">
                    @csrf
                    @if(auth()->user() == $postIdeaUser)
                    <button type="submit" class="c-btn p-ideaDetail__btn--disabled" disabled>
                        アイディア投稿者は購入できません
                    </button>
                    @elseif(auth()->user()->id == $buy_user_id)
                    <button type="submit" class="c-btn p-ideaDetail__btn--disabled" disabled>
                        購入済みです
                    </button>
                    @else
                    <button type="submit" class="c-btn p-ideaDetail__btn">
                        購入する
                    </button>
                    @endif
                </form>
            </div>

            <div class="p-ideaDetail__formContainer">
                <form class="p-ideaDetail__form" action="{{ route('idea_review', $postidea->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="radio" value="1" name="stars">
                    <i class="far fa-star"></i>
                    <input type="radio" value="2" name="stars">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <textarea name="comment" id="" cols="30" rows="10"></textarea>
                    <button type="submit">投稿する</button>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')