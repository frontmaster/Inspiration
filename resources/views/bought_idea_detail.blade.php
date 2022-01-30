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
                        <div class="p-ideaDetail__item">
                            <label for="postUser" class="p-ideaDetail__label">アイディア投稿者</label>
                            <div class="p-ideaDetail__postUserInfo">
                                <img src="/img/person.jpg" alt="" class="c-img p-ideaDetail__img" />
                                <p class="p-ideaDetail__postUserInfo--name">退会したユーザー</p>
                            </div>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="idea" class="p-ideaDetail__label">アイディア名</label>
                            <p class="p-ideaDetail__item--part">{{ $boughtidea->idea_name }}</p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="category" class="p-ideaDetail__label">カテゴリ</label>
                            <p class="p-ideaDetail__item--part">
                                {{ $category->category_name }}
                            </p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="summary" class="p-ideaDetail__label">概要</label>
                            <p class="p-ideaDetail__item--part">{{ $boughtidea->summary }}</p>
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="content" class="p-ideaDetail__label">内容</label>
                            <p class="p-ideaDetail__item--part">{{ $boughtidea->content }}</p> 
                        </div>

                        <div class="p-ideaDetail__item">
                            <label for="price" class="p-ideaDetail__label">価格</label>
                            <p class="p-ideaDetail__item--part">¥{{ number_format($boughtidea->price) }}</p>
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
            </div>


            <div class="p-ideaDetail__formContainer">

                <button type="submit" class="c-btn p-ideaDetail__btn--disabled" disabled>
                    購入済みです
                </button>
            </div>




            <div class="p-ideaDetail__review">
                <h1 class="p-ideaDetail__title--review">レビュー一覧</h1>
                @if($ideaReview->isEmpty())
                <p class="p-ideaDetail__sentence">まだレビューはありません</p>
                @else
                @foreach($ideaReview as $review)
                <div class="p-ideaDetail__reviewContainer">
                    <div class="p-ideaDetail__postUserInfo--review">
                        @if($review->user->user_img == null)
                        <img src="/img/person.jpg" alt="" class="c-img p-ideaDetail__img" />
                        <p class="p-ideaDetail__reviewContainer--part">{{ $review->user->name }}</p>
                        @else
                        <img src="{{ '/' . $review->user->user_img }}" alt="" class="c-img p-ideaDetail__img" />
                        <p class="p-ideaDetail__postUserInfo--name">{{ $review->user->name }}</p>
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
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')