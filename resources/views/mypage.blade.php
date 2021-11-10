@extends('layouts.master')

@section('title', 'マイページ')

@section('header')
@parent
@endsection

@section('content')
<div id="app">
    <main class="l-main">
        <h1 class="p-mypage__title">マイページ</h1>
        <div class="p-mypage">
            <div class="l-sidebar">
                <ul>
                    <li class="c-sidebar__menu"><a href="" class="c-sidebar__menu--link">マイページ</a></li>
                    <li class="c-sidebar__menu"><a href="{{ route('projectList') }}" class="c-sidebar__menu--link">案件一覧</a></li>
                    <li class="c-sidebar__menu"><a href="{{ route('projectPost') }}" class="c-sidebar__menu--link">案件投稿</a></li>
                    <li class="c-sidebar__menu"><a href="{{ route('postProjectList', auth()->user()->id) }}" class="c-sidebar__menu--link">投稿案件一覧</a></li>
                    <li class="c-sidebar__menu"><a href="{{ route('profile', auth()->user()->id) }}" class="c-sidebar__menu--link">プロフィール</a></li>
                </ul>
            </div>

            <div class="p-mypage__content">
                <h2 class="p-mypage__title--part">登録済み案件一覧</h2>
                <div class="p-mypage__wrapper">
                    <div class="p-mypage__registProjectListWrap">
                        @foreach($projects as $project)
                        <div class="p-mypage__registProjectListContainer">
                            <div class="p-mypage__part">
                                <label for="" class="p-mypage__part--label">タイトル</label>
                                <h3>{{ $project->title }}</h3>
                            </div>
                            <div class="p-mypage__part">
                                <label for="" class="p-mypage__part--label">案件種別</label>
                                <h3>{{ $project->category_name }}</h3>
                            </div>
                            <a href="{{ route('projectDetail', $project->id) }}" class="c-btn p-mypage__btn">案件詳細</a>
                        </div>
                        @endforeach
                    </div>
                    <div class="p-mypage__pagination">
                        {{$projects->links()}}
                    </div>
                </div>

                <h2 class="p-mypage__title--part">応募済み案件一覧</h2>
                <div class="p-mypage__wrapper">
                    <div class="p-mypage__applyProjectListWrap">
                        @foreach($applyProjects as $applyProject)
                        <div class="p-mypage__applyProjectListContainer">
                            <div class="p-mypage__part">
                                <label for="" class="p-mypage__part--label">タイトル</label>
                                <h3>{{ $applyProject->title }}</h3>
                            </div>
                            <div class="p-mypage__part">
                                <label for="" class="p-mypage__part--label">案件種別</label>
                                <h3>{{ $applyProject->category_name }}</h3>
                            </div>
                            <div class="p-mypage__part">
                                <label for="" class="p-mypage__part--label">金額</label>
                                <h3>¥{{ number_format($applyProject->price_min) }}</h3>
                                <span>〜</span>
                                <h3>¥{{ number_format($applyProject->price_max) }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="p-mypage__pagination">

                    </div>
                </div>
                <h2 class="p-mypage__title--part">コメントしたメッセージ一覧</h2>
                <div class="p-mypage__wrapper--msg">
                    <div class="p-mypage__msg">
                        @foreach($messages as $msg)
                        @if($msg->from_user_id == auth()->id())
                        <a href="{{ route('projectDetail', $msg->getProjectId()) }}">
                            <div class="p-mypage__msg--part">
                                <P>{{ $msg->getProject() }}</P>
                                <p class="p-mypage__msg--body">{{ $msg->body }}</p>
                            </div>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
                <h2 class="p-mypage__title--part">ダイレクトメッセージ一覧</h2>
                <div class="p-mypage__wrapper--msg">
                    <div class="p-mypage__msg">

                        @foreach($bords as $bord)
                        @if($bord->post_user == auth()->id() and $bord->getBody() != null)
                        <a href="{{route('directMessage', $bord->apply_project_id)}}">
                            <div class="p-mypage__msg--part">
                                <P>{{ $bord->getUserName() }}</P>
                                <p class="p-mypage__msg--body">{{ $bord->getBody()}}</p>
                            </div>
                        </a>

                        @elseif($bord->post_user == auth()->id() and $bord->getBody() == null)
                        <a href="{{route('directMessage', $bord->apply_project_id)}}">
                            <div class="p-mypage__msg--part">
                                <P>{{ $bord->getUserName() }}</P>
                                <p class="p-mypage__msg--body">新規応募があります</p>
                            </div>
                        </a>

                        @elseif($bord->apply_user == auth()->id() and $bord->getBody() != null)
                        <a href="{{route('directMessage', $bord->apply_project_id)}}">
                            <div class="p-mypage__msg--part">
                                <P>{{ $bord->getUserName() }}</P>
                                <p class="p-mypage__msg--body">{{$bord->getBody()}}</p>
                            </div>
                        </a>
                        @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection

@section('footer')
@parent
@endsection