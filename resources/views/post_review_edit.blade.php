@extends('layouts.master')

@section('title', 'レビュー編集')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-reviewEdit">
        @component('component.sidebar')
        @endcomponent

        <div class="p-reviewEdit__content">
            <h1 class="p-reviewEdit__title">レビュー編集</h1>
            <div class="p-reviewEdit__formContainer--review">
                <form class="p-reviewEdit__form--review" action="{{ route('review_update', $reviews->id) }}" method="POST">
                    @csrf
                    <div class="p-reviewEdit__starContainer">
                        <h2 class="p-reviewEdit__starContainer--title">現在の評価</h2>
                        <div class="p-reviewEdit__starContainer--part">
                            @if($reviews->stars == 1)
                            <p class="p-reviewEdit__starContainer--part">
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                            </p>
                            @elseif($reviews->stars == 2)
                            <p class="p-reviewEdit__starContainer--part">
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                            </p>
                            @elseif($reviews->stars == 3)
                            <p class="p-reviewEdit__starContainer--part">
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                            </p>
                            @elseif($reviews->stars == 4)
                            <p class="p-reviewEdit__starContainer--part">
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                            </p>
                            @else
                            <p class="p-reviewEdit__starContainer--part">
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                                <i class="p-reviewEdit__reviewStar fas fa-star"></i>
                            </p>
                            @endif
                        </div>
                        <h2 class="p-reviewEdit__starContainer--title">新しい評価</h2>
                        @error('stars')
                        <span class="c-errMsg p-reviewEdit__errMsg">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                        <div class="p-reviewEdit__starContainer--part">
                            <input type="radio" value="5" name="stars" class="p-reviewEdit__radio">
                            <label for=""><i class="p-reviewEdit__star fas fa-star"></i></label>
                            <input type="radio" value="4" name="stars" class="p-reviewEdit__radio">
                            <label for=""><i class="p-reviewEdit__star fas fa-star"></i></label>
                            <input type="radio" value="3" name="stars" class="p-reviewEdit__radio">
                            <label for=""><i class="p-reviewEdit__star fas fa-star"></i></label>
                            <input type="radio" value="2" name="stars" class="p-reviewEdit__radio">
                            <label for=""><i class="p-reviewEdit__star fas fa-star"></i></label>
                            <input type="radio" value="1" name="stars" class="p-reviewEdit__radio">
                            <label for=""><i class="p-reviewEdit__star fas fa-star"></i></label>
                        </div>
                    </div>
                    <h2 class="p-reviewEdit__starContainer--title">レビュー</h2>
                    @error('review')
                    <span class="c-errMsg p-reviewEdit__errMsg">
                        <p>{{ $message }}</p>
                    </span>
                    @enderror
                    <textarea id="js-count-review" name="review" class="p-reviewEdit__textarea" placeholder="10000文字以内で入力してください">{{ old('comment', $reviews->comment) }}</textarea>
                    <div class="p-reviewEdit__countarea">
                        <span id="count-l" class="c-countarea--long js-show-count-review">0</span>/10000
                    </div>

                    <div class="p-reviewEdit__button--review">
                        <button type="submit" class="c-btn p-reviewEdit__btn--review">編集</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')