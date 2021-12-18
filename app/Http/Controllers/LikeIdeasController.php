<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeIdeasController extends Controller
{
    //気になる一覧表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $likeIdeas = Auth::user()->Likes()->get();

        //dd($likeIdeas);

        return view('like_idea_list', compact('likeIdeas'));
    }
}
