@extends('layouts.master')

@section('title', 'アイディア詳細')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-ideaDetail">
        <div class="p-ideaDetail__modal js-show-modal-target">
            <p class="p-ideaDetail__sentence--modal">アイディアを購入しますか？</p>
            <form method="POST" action="{{ route('idea_buy', $postidea->id) }}" class="p-ideaDetail__form--modal">
                @csrf
                <div class="p-ideaDetail__button--modal">
                    <button type="button" class="c-btn p-ideaDetail__btn--cancel js-hide-modal">キャンセル</button>
                    <button type="submit" class="c-btn p-ideaDetail__btn--buy">購入</button>
                </div>
            </form>
        </div>

        <div class="p-postIdeaEdit__modal--cover js-show-modal-cover"></div>
        @component('component.sidebar')
        @endcomponent

        <div class="p-ideaDetail__content">
            <div class="p-ideaDetail__Container">
                <h1 class="p-ideaDetail__title">アイディア詳細</h1>
                <div class="p-ideaDetail__partContainer">
                    <div class="p-ideaDetail__part">
                        <div class="p-ideaDetail__item">
                            <label for="postUser" class="p-ideaDetail__label">アイディア投稿者</label>
                            <div class="p-ideaDetail__postUserInfo">
                                @if(optional($postIdeaUser)->user_img == null)
                                <img src="/img/person.jpg" alt="" class="c-img p-ideaDetail__img" />
                                @else
                                <img src="{{'/' . $postIdeaUser->user_img}}" alt="" class="c-img p-ideaDetail__img" />
                                @endif
                                @if($postIdeaUser == null)
                                <p class="p-ideaDetail__postUserInfo--name">退会したユーザー</p>
                                @else
                                <p class="p-ideaDetail__postUserInfo--name">{{ $postIdeaUser->name }}</p>
                                @endif
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
                            @if($buy_user_id != auth()->user()->id && optional($postIdeaUser)->id != auth()->user()->id)
                            <p class="p-ideaDetail__item--part">購入後に表示されます</p>
                            @else
                            <p class="p-ideaDetail__item--part">{{ $postidea->content }}</p>
                            @endif
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="price" class="p-ideaDetail__label">価格</label>
                            <p class="p-ideaDetail__item--part">¥{{ number_format($postidea->price) }}</p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="score" class="p-ideaDetail__label">平均評価点数</label>
                            @if(isset($scores))
                            <p class="p-ideaDetail__item--part">{{ number_format($scores->star, 1) }}点</p>
                            @else
                            <p class="p-ideaDetail__item--part">まだレビューされていません</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-ideaDetail__button">
                    <a href="https://twitter.com/intent/tweet?url=https://front-test.com/idea_detail/{{ $idea_id }}&text=簡単にアイディアを販売・購入できるアイディアマッチングサービス Inspiration" target="blank_" class="c-btn p-ideaDetail__button--share">
                        <i class="fa-brands fa-x-twitter"></i>
                        シェアする
                    </a>

                    @if(!$already_liked)
                    <div class="p-ideaDetail__likeContainer">
                        <p class="c-btn p-ideaDetail__btn--like js-like-word js-click-like" data-ideaid="{{ $idea_id }}">気になる</p>
                        <i class="fas fa-heart p-ideaDetail__heart js-like-heart"></i>
                    </div>

                    @else
                    <div class="p-ideaDetail__likeContainer">
                        <p class="c-btn p-ideaDetail__btn--unlike likebtn js-unlike-word js-click-like" data-ideaid="{{ $idea_id }}">気になるを解除する</p>
                        <i class="fas fa-heart p-ideaDetail__heart js-like-heart likeheart"></i>
                    </div>
                    @endif
                </div>
            </div>


            <div class="p-ideaDetail__formContainer">


                @if(auth()->user() == $postIdeaUser)
                <button type="submit" class="c-btn p-ideaDetail__btn--disabled" disabled>
                    アイディア投稿者は購入できません
                </button>
                @elseif(auth()->user()->id == $buy_user_id)
                <button type="submit" class="c-btn p-ideaDetail__btn--disabled" disabled>
                    購入済みです
                </button>
                @elseif($postidea->user == null)
                <button type="submit" class="c-btn p-ideaDetail__btn--disabled" disabled>
                    投稿者が退会しているため購入できません
                </button>
                @else
                <button type="button" class="c-btn p-ideaDetail__btn js-show-modal">
                    購入する
                </button>
                @endif

            </div>

            @if($postIdeaUser != auth()->user() and $bought_idea != null)
            <div class="p-ideaDetail__formContainer--review">
                <h1 class="p-ideaDetail__title">アイディアをレビュー</h1>
                <form class="p-ideaDetail__form--review" action="{{ route('idea_review', $postidea->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="p-ideaDetail__starContainer">
                        <h2 class="p-ideaDetail__starContainer--title">評価</h2>
                        @error('stars')
                        <span class="c-errMsg p-ideaDetail__errMsg">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                        <div class="p-ideaDetail__starContainer--part">
                            <input type="radio" value="5" name="stars" class="p-ideaDetail__radio">
                            <label for=""><i class="p-ideaDetail__star fas fa-star"></i></label>
                            <input type="radio" value="4" name="stars" class="p-ideaDetail__radio">
                            <label for=""><i class="p-ideaDetail__star fas fa-star"></i></label>
                            <input type="radio" value="3" name="stars" class="p-ideaDetail__radio">
                            <label for=""><i class="p-ideaDetail__star fas fa-star"></i></label>
                            <input type="radio" value="2" name="stars" class="p-ideaDetail__radio">
                            <label for=""><i class="p-ideaDetail__star fas fa-star"></i></label>
                            <input type="radio" value="1" name="stars" class="p-ideaDetail__radio">
                            <label for=""><i class="p-ideaDetail__star fas fa-star"></i></label>
                        </div>
                    </div>
                    <h2 class="p-ideaDetail__starContainer--title">レビュー</h2>
                    @error('review')
                    <span class="c-errMsg p-ideaDetail__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                    <textarea id="js-count-review" name="review" class="p-ideaDetail__textarea" placeholder="10000文字以内で入力してください"></textarea>
                    <div class="p-ideaDetail__countarea">
                        <span id="count-l" class="c-countarea--long js-show-count-review">0</span>/10000
                    </div>
                    @if($review)
                    <div class="p-ideaDetail__button--disabled">
                        <button type="submit" class="c-btn p-ideaDetail__btn--disabled" disabled>投稿済みです</button>
                    </div>
                    @elseif($sale_user == null)
                    <div class="p-ideaDetail__button--disabled">
                        <button type="submit" class="c-btn p-ideaDetail__btn--disabled" disabled>退会したユーザーには投稿できません</button>
                    </div>
                    @else
                    <div class="p-ideaDetail__button--review">
                        <button type="submit" class="c-btn p-ideaDetail__btn--review">投稿する</button>
                    </div>
                    @endif
                </form>
            </div>
            @endif


            <div class="p-ideaDetail__review">
                <h1 class="p-ideaDetail__title--review">レビュー一覧</h1>
                @if($ideaReview->isEmpty())
                <p class="p-ideaDetail__sentence">まだレビューはありません</p>
                @else
                @foreach($ideaReview as $review)
                <div class="p-ideaDetail__reviewContainer">
                    <div class="p-ideaDetail__postUserInfo--review">
                        @if($review->user_img == null)
                        <img src="/img/person.jpg" alt="" class="c-img p-ideaDetail__img" />
                        <p class="p-ideaDetail__reviewContainer--part">{{ $review->user_name }}</p>
                        @else
                        <img src="{{ '/' . $review->user_img }}" alt="" class="c-img p-ideaDetail__img" />
                        <p class="p-ideaDetail__postUserInfo--name">{{ $review->user_name }}</p>
                        @endif
                    </div>

                    <div class="p-ideaDetail__starContainer">
                        @if($review->stars == 1)
                        <p class="p-ideaDetail__starContainer--part">
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                        </p>
                        @elseif($review->stars == 2)
                        <p class="p-ideaDetail__starContainer--part">
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                        </p>
                        @elseif($review->stars == 3)
                        <p class="p-ideaDetail__starContainer--part">
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                        </p>
                        @elseif($review->stars == 4)
                        <p class="p-ideaDetail__starContainer--part">
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                        </p>
                        @else
                        <p class="p-ideaDetail__starContainer--part">
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                            <i class="p-ideaDetail__reviewStar fas fa-star"></i>
                        </p>
                        @endif
                    </div>

                    <div class="p-ideaDetail__item">
                        <p class="p-ideaDetail__item--part">{{ $review->comment }}</p>
                    </div>
                    @if(auth()->user()->id == $review->post_user_id)
                    <div class="p-ideaDetail__item--link">
                        <a href="{{ route('review_edit', $review->id) }}" class="c-btn p-ideaDetail__btn--link">編集</a>
                    </div>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')