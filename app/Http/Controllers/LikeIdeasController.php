<?php

namespace App\Http\Controllers;

use App\Like;
use App\PostIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeIdeasController extends Controller
{
    //気になるリスト一覧表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $likeIdeas = Auth::user()->Likes()->get();

        return view('like_idea_list', compact('likeIdeas'));
    }
}
