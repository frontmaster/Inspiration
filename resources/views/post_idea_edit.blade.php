@extends('layouts.master')

@section('title', 'アイディア編集')

@include('layouts.head')

@include('layouts.header')

@section('content')

<main class="l-main" id="app">
    <div class="p-postIdea">
        @component('component.sidebar')
        @endcomponent

        <div class="p-postIdea__content">
            <h1 class="p-postIdea__title">アイディア編集</h1>
            <form method="POST" action="{{ route('post_idea_edit', $postidea->id) }}" class="p-postIdea__form">
                @csrf

                @error('category_id')
                <span class="c-errMsg p-postIdea__errMsg">
                   <p>{{ $message }}</p>
                </span>
                @enderror

                <div class="p-postIdea__part">
                    <label for="category_id" class="p-postIdea__label">カテゴリ
                        <span class="p-postIdea__require">必須</span>
                    </label>
                    <select required name="category_id" id="selectBox" class="p-postIdea__select @error('category') is-error @enderror">
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
                <span class="c-errMsg p-postIdea__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-postIdea__part">
                    <label for="idea" class="p-postIdea__label">アイディア名
                        <span class="p-postIdea__require">必須</span>
                    </label>
                    <input type="text" id="js-count-short" class="p-postIdea__input @error('idea_name') is-error @enderror" name="idea_name" value="{{ old('idea_name', $postidea->idea_name) }}" 
                    placeholder="20文字以内で入力してください" onkeyup="ShowLength(value, 'count-short');">
                    <div class="p-profile__countarea">
                        <span id="count-short" class="c-countarea--short js-show-count-short">0</span>/20
                    </div>
                </div>



                @error('summary')
                <span class="c-errMsg p-postIdea__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-postIdea__part">
                    <label for="summary" class="p-postIdea__label">概要
                        <span class="p-postIdea__require">必須</span>
                    </label>
                    <textarea name="summary" id="js-count-mid" class="p-postIdea__textarea" placeholder="100文字以内で入力してください" onkeyup="ShowLength(value, 'count-mid');">{{ old('summary', $postidea->summary) }}</textarea>
                    <div class="p-postIdea__countarea--comment">
                        <span id="count-mid" class="c-countarea--mid js-show-count-mid">0</span>/100
                    </div>
                </div>

                @error('content')
                <span class="c-errMsg p-postIdea__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-postIdea__part">
                    <label for="content" class="p-postIdea__label">内容
                        <span class="p-postIdea__require">必須</span>
                    </label>
                    <textarea id="js-count-long" name="content" class="p-postIdea__textarea" placeholder="10000文字以内で入力してください" onkeyup="ShowLength(value, 'count-long');">{{ old('content', $postidea->content) }}</textarea>
                    <div class="p-postIdea__countarea--content">
                        <span id="count-long" class="c-countarea--long js-show-count-long">0</span>/10000
                    </div>
                </div>

                @error('price')
                <span class="c-errMsg p-postIdea__errMsg">
                    <p>{{ $message }}</p>
                </span>
                @enderror
                <div class="p-postIdea__part">
                    <label for="price" class="p-postIdea__label">価格
                        <span class="p-postIdea__require">必須</span>
                    </label>
                    <div class="p-postIdea__pricecontainer">
                        <input type="number" class="p-postIdea__input @error('price') is-error @enderror" name="price" value="{{ $postidea->price }}" placeholder="半角数字">
                        <span class="p-postIdea__pricetag">円</span>
                    </div>
                </div>

                <div class="p-postIdea__button">
                    <button type="submit" class="c-btn p-postIdea__btn">
                        編集する
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@include('layouts.footer')