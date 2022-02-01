<?php

namespace App\Http\Controllers;

use App\PostIdea;
use App\IdeaReview;
use Illuminate\Http\Request;
use App\Mail\ToPostIdeaUserReview;
use Illuminate\Support\Facades\DB;
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

        $postIdea = PostIdea::withTrashed()->find($id);
        $sale_user = $postIdea->user()->first();
        $buy_user = auth()->user();

        $review = new IdeaReview;
        if (DB::table('idea_reviews')->where('post_idea_id', $id)->where('post_user_id', auth()->user()->id)->doesntExist() && $postIdea->deleted_at == null) {
            $review->post_idea_id = $id;
            $review->post_user_id = Auth::user()->id;
            $review->to_user_id = $postIdea->user->id;
            $review->idea_name = $postIdea->idea_name;
            $review->user_img = $buy_user->user_img;
            $review->user_name = $buy_user->name;
            $review->stars = $request->stars;
            $review->comment = $request->review;
            $review->save();

            Mail::to($sale_user->email)->send(new ToPostIdeaUserReview($buy_user));

            return redirect('idea_detail' . '/' . $id)->with('flash_message', 'アイディアの評価、口コミを投稿しました');
        } else {
            return redirect('mypage' . '/' . auth()->user()->id)->with('flash_message', 'アイディアの評価、口コミの投稿は1回までしかできません。また、退会したユーザには投稿できません');
        }
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

    //レビュー編集画面表示
    public function edit($id)
    {
        if (!ctype_digit($id)) {
            return redirect('/');
        }
        
        $reviews = IdeaReview::find($id);
        
        if (DB::table('idea_reviews')->where('id', $id)->exists() && auth()->user()->id != $reviews->to_user_id) {
            return view('post_review_edit', compact('reviews'));
        }else{
            return redirect('mypage' . '/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
    }

    //編集したレビューの更新
    public function update(Request $request, $id)
    {
        if (!ctype_digit($id)) {
            return redirect('post_review_edit/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'review' => 'required|max:10000'
        ]);

        $reviews = IdeaReview::find($id);
        $reviews->stars = $request->stars;
        $reviews->comment = $request->review;
        $reviews->save();

        return redirect('mypage' . '/' . auth()->user()->id)->with('flash_message', 'レビューを編集しました');
    }
}
