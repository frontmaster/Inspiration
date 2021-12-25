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

    //気になるリスト一覧画面から「気になる」を解除
    public function delete(Request $request, $id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $likeIdeas = Auth::user()->Likes()->get();
        $user_id = Auth::user()->id;
        $like_id = $request->$likeIdeas->id;
        $user_like = Like::where('user_id', $user_id)->where('id', $like_id )->first();

        $user_like->delete();

    }

}
