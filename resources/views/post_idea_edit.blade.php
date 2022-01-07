@extends('layouts.master')

@section('title', 'アイディア編集')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
<div class="p-postIdeaEdit__modal js-show-modal-target">
        <p class="p-postIdeaEdit__sentence">アイディアを削除しますか？</p>
        <form method="POST" action="{{ route('idea_delete_post', $postidea->id) }}" class="p-postIdeaEdit__form--modal">
            @method('DELETE')
            @csrf
            <div class="p-postIdeaEdit__button--modal">
                <button type="button" class="c-btn p-postIdeaEdit__btn js-hide-modal">キャンセル</button>
                <button type="submit" class="c-btn p-postIdeaEdit__btn--delete">削除</button>
            </div>
        </form>
    </div>

    <div class="p-postIdeaEdit__modal--cover js-show-modal-cover"></div>
    <div class="p-postIdeaEdit">
        @component('component.sidebar')
        @endcomponent

        <div class="p-postIdeaEdit__content">
            <h1 class="p-postIdeaEdit__title">アイディア編集</h1>
            <form method="POST" action="{{ route('post_idea_update', $postidea->id) }}" class="p-postIdeaEdit__form">
                @csrf
                @error('category_id')
                <span class="c-errMsg p-postIdea__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror

                <div class="p-postIdeaEdit__part">
                    <label for="category_id" class="p-postIdeaEdit__label">カテゴリ
                        <span class="p-postIdeaEdit__require">必須</span>
                    </label>
                    <select required name="category_id" id="selectBox" class="p-postIdeaEdit__select @error('category') is-error @enderror">
                        <option value="0" hidden selected disabled>選択してください</option>
                        @foreach ($categories as $category)
                        @if(!is_null(old('category_id')))
                        @if($category->id == old('category_id'))
                        <option value="{{ optional($category)->id }}" selected>{{ optional($category)->name }}</option>
                        @else
                        <option value="{{ optional($category)->id }}">{{ optional($category)->category_name }}</option>
                        @endif
                        @else
                        @if($category->id == $postidea->category_id)
                        <option value="{{ optional($category)->id }}" selected>{{ optional($category)->category_name }}</option>
                        @else
                        <option value="{{ optional($category)->id }}">{{ optional($category)->category_name }}</option>
                        @endif
                        @endif
                        @endforeach
                    </select>
                </div>


                @error('idea_name')
                <span class="c-errMsg p-postIdeaEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-postIdeaEdit__part">
                    <label for="idea" class="p-postIdeaEdit__label">アイディア名
                        <span class="p-postIdeaEdit__require">必須</span>
                    </label>
                    <input type="text" id="js-count-idea" class="p-postIdeaEdit__input @error('idea_name') is-error @enderror" name="idea_name" value="{{ old('idea_name', $postidea->idea_name) }}" placeholder="20文字以内で入力してください">
                    <div class="p-postIdeaEdit__countarea">
                        <span id="count-short" class="c-countarea--short js-show-count-idea">0</span>/20
                    </div>
                </div>

                @error('summary')
                <span class="c-errMsg p-postIdeaEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-postIdeaEdit__part">
                    <label for="summary" class="p-postIdeaEdit__label">概要
                        <span class="p-postIdeaEdit__require">必須</span>
                    </label>
                    <textarea name="summary" id="js-count-summary" class="p-postIdeaEdit__textarea" placeholder="100文字以内で入力してください">{{ old('summary', $postidea->summary) }}</textarea>
                    <div class="p-postIdeaEdit__countarea--comment">
                        <span id="count-mid" class="c-countarea--mid js-show-count-summary">0</span>/100
                    </div>
                </div>

                @error('content')
                <span class="c-errMsg p-postIdeaEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-postIdeaEdit__part">
                    <label for="content" class="p-postIdea__label">内容
                        <span class="p-postIdeaEdit__require">必須</span>
                    </label>
                    <textarea id="js-count-content" name="content" class="p-postIdeaEdit__textarea" placeholder="10000文字以内で入力してください">{{ old('content', $postidea->content) }}</textarea>
                    <div class="p-postIdeaEdit__countarea--content">
                        <span id="count-long" class="c-countarea--long js-show-count-content">0</span>/10000
                    </div>
                </div>

                @error('price')
                <span class="c-errMsg p-postIdeaEdit__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-postIdeaEdit__part">
                    <label for="price" class="p-postIdea__label">価格
                        <span class="p-postIdeaEdit__require">必須</span>
                    </label>
                    <div class="p-postIdeaEdit__pricecontainer">
                        <input type="number" class="p-postIdeaEdit__input @error('price') is-error @enderror" name="price" value="{{ $postidea->price }}" placeholder="半角数字">
                        <span class="p-postIdeaEdit__pricetag">円</span>
                    </div>
                </div>

                <div class="p-postIdeaEdit__button">
                    <button type="submit" class="c-btn p-postIdeaEdit__btn">
                        編集
                    </button>
                    <button type="button" class="c-btn p-postIdeaEdit__btn--delete js-show-modal">削除</button>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection

@include('layouts.footer')