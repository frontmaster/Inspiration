<?php

namespace App\Http\Controllers;

use App\BoughtIdea;
use App\IdeaReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BoughtIdeasController extends Controller
{
    //購入したアイディア一覧表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        $user = Auth::user();
        $boughtIdeaLists = $user->BoughtIdeas()->first();
        
        return view('bought_idea_list', compact('boughtIdeaLists'));
    }

    //購入したアイディアの詳細画面表示
    public function detail($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $boughtidea = BoughtIdea::find($id);
        if(DB::table('bought_ideas')->where('id', $id)->exists() && auth()->user()->id == $boughtidea->buy_user_id){
            $category = $boughtidea->category()->first();
            $postidea = $boughtidea->postIdea()->first();
            $ideaReview = IdeaReview::where('post_idea_id', $id)->with('user')->get();
            $scores = IdeaReview::where('post_idea_id', $id)->selectRaw('AVG(stars) as star')
                ->groupBy('post_idea_id')->first();
                return view('bought_idea_detail', compact('boughtidea', 'category', 'postidea', 'ideaReview', 'scores'));
        }else{
            return redirect('mypage' . '/' . auth()->user()->id)->with('flash_message', 'このIDのアイディアは存在しません'); 
        }
    }
}
