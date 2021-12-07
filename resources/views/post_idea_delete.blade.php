@extends('layouts.master')

@section('title', 'アイディア削除')

@include('layouts.head')

@include('layouts.header')

@section('content')
<main class="l-main" id="app">
    <div class="p-ideaDelete__modal js-show-modal-target">
        <p class="p-ideaDelete__sentence">アイディアを削除しますか？</p>
        <form method="POST" action="{{ route('idea_delete_post', $postidea->id) }}" class="p-ideaDelete__form">
            @csrf
            <div class="p-ideaDelete__button--modal">
                <button type="button" class="c-btn p-ideaDelete__btn js-hide-modal">キャンセル</button>
                <button type="submit" class="c-btn p-ideaDelete__btn--delete">削除する</button>
            </div>
        </form>
    </div>

    <div class="p-ideaDelete__modal--cover js-show-modal-cover"></div>
    <div class="p-ideaDelete">
        <div class="p-ideaDelete__content">
            <h3 class="p-ideaDelete__title">アイディア削除</h3>
            <p class="p-ideaDelete__content--sentence">アイディアを削除する方は下記のボタンを押してください</p>
            <div class="p-ideaDelete__button">
                <button type="button" class="c-btn p-ideaDelete__btn--delete js-show-modal">
                    削除する
                </button>
            </div>

            <a href="{{ route('post_idea_edit', $postidea->id) }}"class="p-ideaDelete__link">アイディア編集画面へ戻る</a>

        </div>
    </div>
</main>
@endsection

@include('layouts.footer')