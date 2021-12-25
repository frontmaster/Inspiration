<div class="l-sidebar">
    <ul>
        <div class="c-sidebar__menublock">
            <h3 class="c-sidebar__menu--title">アイディアを購入したい方</h3>
            <li class="c-sidebar__menu">
                <a href="{{ route('idea_lists') }}" class="c-sidebar__menu--link">アイディア一覧から探す</a>
            </li>
            <li class="c-sidebar__menu">
                <a href="" class="c-sidebar__menu--link">レビュー一覧から探す</a>
            </li>
            <li class="c-sidebar__menu">
                <a href="{{ route('like_idea_lists', auth()->user()->id)}}" class="c-sidebar__menu--link">気になるリスト一覧から探す</a>
            </li>
        </div>

        <div class="c-sidebar__menublock">
            <h3 class="c-sidebar__menu--title">アイディアを投稿したい方</h3>
            <li class="c-sidebar__menu--short">
                <a href="{{ route('post_idea_show', auth()->user()->id) }}" class="c-sidebar__menu--link">アイディアを投稿する</a>
            </li>
        </div>

        <div class="c-sidebar__menublock">
            <h3 class="c-sidebar__menu--title">アイディア一覧を見る</h3>
            <li class="c-sidebar__menu--mid">
                <a href="{{ route('post_idea_list_show', auth()->user()->id) }}" class="c-sidebar__menu--link">投稿したアイディア一覧</a>
            </li>
            <li class="c-sidebar__menu--mid">
                <a href="{{ route('bought_idea_lists', auth()->user()->id) }}" class="c-sidebar__menu--link">購入したアイディア一覧</a>
            </li>
        </div>
    </ul>
</div>