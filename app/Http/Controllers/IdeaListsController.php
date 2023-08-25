<?php

namespace App\Http\Controllers;

use App\BoughtIdea;
use App\Like;
use App\PostIdea;
use App\IdeaReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class IdeaListsController extends Controller
{
    //アイディア一覧表示
    public function index()
    {
        $ideaLists = PostIdea::with('reviews')->get();

        $reviews = IdeaReview::with('idea')->get();

        return view('idea_list', compact('ideaLists'));

    }
}
