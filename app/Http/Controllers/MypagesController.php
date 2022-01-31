<?php

namespace App\Http\Controllers;

use App\BoughtIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypagesController extends Controller
{
    //マイページ表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/');
        }

        $user = Auth::user();

        

        $boughtIdeaLists = $user->BoughtIdeas()->orderBy('created_at', 'DESC')->take(5)->get();

        $likeIdeaLists = $user->Likes()->orderBy('created_at', 'DESC')->take(5)->get();

        $postIdeaLists = $user->PostIdeas()->orderBy('created_at', 'DESC')->take(5)->get();

        $reviewLists = $user->reviews()->orderBy('created_at', 'DESC')->take(5)->get();

        

        

        return view('mypage', compact('boughtIdeaLists', 'likeIdeaLists', 'postIdeaLists', 'reviewLists'));
    }
}
