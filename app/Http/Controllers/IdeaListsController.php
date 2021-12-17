<?php

namespace App\Http\Controllers;

use App\Like;
use App\PostIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaListsController extends Controller
{
    //アイディア一覧表示
    public function index()
    {
        
        $ideaLists = PostIdea::all();

        return view('idea_list', compact('ideaLists'));
    }

}
