<?php

namespace App\Http\Controllers;

use App\BoughtIdea;
use Illuminate\Http\Request;

class BoughtIdeasController extends Controller
{
    //購入したアイディア一覧表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        $boughtIdeaLists = BoughtIdea::all();

        return view('bought_idea_list', compact('boughtIdeaLists'));
    }
}
