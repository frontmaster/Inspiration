<?php

namespace App\Http\Controllers;

use App\IdeaReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function review(Request $request, $id)
    {
        $request->validate([
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'required'
        ]);

        $review = new IdeaReview;
        $review->post_idea_id = $id;
        $review->post_user_id = Auth::user()->id;
        $review->stars = $request->stars;
        $review->comment = $request->comment;
        $review->save();

        return redirect('idea_detail' . '/' . $id)->with('flash_message', 'アイディアの評価、口コミを投稿しました');  
    }
}
