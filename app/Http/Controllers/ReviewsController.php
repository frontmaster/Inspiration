<?php

namespace App\Http\Controllers;

use App\PostIdea;
use App\IdeaReview;
use Illuminate\Http\Request;
use App\Mail\ToPostIdeaUserReview;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReviewsController extends Controller
{
    //レビュー投稿
    public function review(Request $request, $id)
    {
        $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'review' => 'required|max:10000'
        ]);

        $postIdea = PostIdea::find($id);
        $sale_user = $postIdea->user()->first();
        $buy_user = auth()->user();

        $review = new IdeaReview;
        $review->post_idea_id = $id;
        $review->post_user_id = Auth::user()->id;
        $review->to_user_id = $postIdea->user->id;
        $review->stars = $request->stars;
        $review->comment = $request->review;
        $review->save();

        Mail::to($sale_user->email)->send(new ToPostIdeaUserReview($buy_user));

        return redirect('idea_detail' . '/' . $id)->with('flash_message', 'アイディアの評価、口コミを投稿しました');
    }

    //レビュー一覧画面表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/');
        }
        $reviews = Auth::user()->reviews()->get();

        return view('review_list', compact('reviews'));
    }
}
