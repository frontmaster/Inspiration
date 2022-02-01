@extends('layouts.master')

@section('title', 'マイページ')

@include('layouts.head')

@include('layouts.header')

@section('content')
<div id="app">
    <main class="l-main" id="app">
        <div class="p-mypage">
            <div class="p-mypage__sidebarContainer">
                @component('component.sidebar')
                @endcomponent
                <a href="{{ route('profile', auth()->user()->id) }}" class="c-btn p-mypage__btn--prof">プロフィールを編集する</a>
            </div>

            <div class="p-mypage__content">
                

                <div class="p-mypage__Container">
                
                    <div class="p-mypage__itemContainer">
                        <div class="p-mypage__itemContainer--head">
                            <h1 class="p-mypage__title">購入したアイディア一覧</h1>
                            <a href="{{ route('bought_idea_lists', auth()->user()->id) }}" class="p-mypage__link">全件表示</a>
                        </div>
                        @if($boughtIdeaLists->isEmpty())
                        <p class="p-mypage__sentence">まだ購入したアイディアはありません</p>
                        @else
                        @foreach($boughtIdeaLists as $boughtIdeaList)
                        <div class="p-mypage__item">
                            <div class="p-mypage__item--part">
                                <label for="idea" class="p-mypage__label">アイディア名</label>
                                <p class="p-mypage__item--part">{{ $boughtIdeaList->idea_name}}</p>
                            </div>
                            <div class="p-mypage__item--part">
                                <label for="category" class="p-mypage__label">カテゴリ</label>
                                <p class="p-mypage__item--part">{{ $boughtIdeaList->category->category_name }}</p>
                            </div>
                            <div class="p-mypage__item--part">
                                <label for="price" class="p-mypage__label">価格</label>
                                <p class="p-mypage__item--part">¥{{ number_format($boughtIdeaList->price) }}</p>
                            </div>
                            <div class="p-mypage__item--part">   
                                <a href="{{ route('idea_detail', $boughtIdeaList->idea_id) }}" class="p-mypage__item--link c-btn">詳細を見る</a>  
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="p-mypage__itemContainer">
                        <div class="p-mypage__itemContainer--head">
                            <h1 class="p-mypage__title">気になるリスト一覧</h1>
                            <a href="{{ route('like_idea_lists', auth()->user()->id) }}" class="p-mypage__link">全件表示</a>
                        </div>
                        @if($likeIdeaLists->isEmpty())
                        <p class="p-mypage__sentence">まだ気になるアイディアはありません</p>
                        @else
                        @foreach($likeIdeaLists as $likeIdeaList)
                        <div class="p-mypage__item">
                            <div class="p-mypage__item--part">
                                <label for="idea" class="p-mypage__label">アイディア名</label>
                                <p class="p-mypage__item--part">{{ $likeIdeaList->idea_name }}</p>
                            </div>
                            <div class="p-mypage__item--part">
                                <label for="category" class="p-mypage__label">カテゴリ</label>
                                <p class="p-mypage__item--part">{{ $likeIdeaList->category->category_name }}</p>
                            </div>
                            <div class="p-mypage__item--part">
                                <label for="price" class="p-mypage__label">価格</label>
                                <p class="p-mypage__item--part">¥{{ number_format($likeIdeaList->price) }}</p>
                            </div>
                            <div class="p-mypage__item--part">
                                <a href="{{ route('idea_detail', $likeIdeaList->idea_id) }}" class="p-mypage__item--link c-btn">詳細を見る</a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="p-mypage__itemContainer">
                        <div class="p-mypage__itemContainer--head">
                            <h1 class="p-mypage__title">投稿したアイディア一覧</h1>
                            <a href="{{ route('post_idea_list_show', auth()->user()->id) }}" class="p-mypage__link">全件表示</a>
                        </div>
                        @if($postIdeaLists->isEmpty())
                        <p class="p-mypage__sentence">まだ投稿したアイディアはありません</p>
                        @else
                        @foreach($postIdeaLists as $postIdeaList)
                        <div class="p-mypage__item">
                            <div class="p-mypage__item--part">
                                <label for="idea" class="p-mypage__label">アイディア名</label>
                                <p class="p-mypage__item--part">{{ $postIdeaList->idea_name}}</p>
                            </div>
                            <div class="p-mypage__item--part">
                                <label for="category" class="p-mypage__label">カテゴリ</label>
                                <p class="p-mypage__item--part">{{ $postIdeaList->category->category_name }}</p>
                            </div>
                            <div class="p-mypage__item--part">
                                <label for="price" class="p-mypage__label">価格</label>
                                <p class="p-mypage__item--part">¥{{ number_format($postIdeaList->price) }}</p>
                            </div>
                            <div class="p-mypage__item--part">
                                <a href="{{ route('idea_detail', $postIdeaList->id) }}" class="p-mypage__item--link c-btn">詳細を見る</a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="p-mypage__itemContainer">
                        <div class="p-mypage__itemContainer--head">
                            <h1 class="p-mypage__title">レビュー一覧</h1>
                            <a href="{{ route('review_lists', auth()->user()->id) }}" class="p-mypage__link">全件表示</a>
                        </div>
                        @if($reviewLists->isEmpty())
                        <p class="p-mypage__sentence">まだレビューはありません</p>
                        @else
                        @foreach($reviewLists as $reviewList)
                        <div class="p-mypage__item--review">
                            <label for="idea" class="p-mypage__label">アイディア名</label>
                            <p class="p-mypage__item--part">{{ $reviewList->idea_name}}</p>
                            <div class="p-mypage__postUserInfo">
                                @if($reviewList->user_img == null)
                                <img src="/img/person.jpg" alt="" class="c-img p-ideaDetail__img" />
                                @else
                                <img src="{{'/' . $reviewList->user_img}}" alt="" class="c-img p-mypage__img" />
                                @endif
                                <p class="p-mypage__item--part">{{ optional($reviewList)->user_name }}</p>
                                
                            </div>
                            @if($reviewList->stars == 1)
                            <p class="p-mypage__item--part">
                                <i class="p-mypage__star fas fa-star"></i>
                            </p>
                            @elseif($reviewList->stars == 2)
                            <p class="p-mypage__item--part">
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                            </p>
                            @elseif($reviewList->stars == 3)
                            <p class="p-mypage__item--part">
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                            </p>
                            @elseif($reviewList->stars == 4)
                            <p class="p-mypage__item--part">
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                            </p>
                            @elseif($reviewList->stars == 5)
                            <p class="p-mypage__item--part">
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                                <i class="p-mypage__star fas fa-star"></i>
                            </p>
                            @endif
                            <p class="p-mypage__item--part">{{ $reviewList->comment }}</p>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection

@include('layouts.footer')