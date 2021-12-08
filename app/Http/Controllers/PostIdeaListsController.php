<?php

namespace App\Http\Controllers;

use App\Category;
use App\PostIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostIdeaListsController extends Controller
{
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        
        $postIdeaLists = Auth::user()->PostIdeas()->get();

        $postideas = Auth::user()->PostIdeas()->first();

        return view('post_idea_list', compact('postIdeaLists', 'postideas'));
    }
}
