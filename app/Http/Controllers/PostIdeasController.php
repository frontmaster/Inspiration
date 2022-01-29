<?php

namespace App\Http\Controllers;

use App\Like;
use App\Category;
use App\PostIdea;
use App\BoughtIdea;
use App\IdeaReview;
use Illuminate\Http\Request;
use App\Mail\ToPostIdeaUserNotice;
use Illuminate\Support\Facades\DB;
use App\Mail\ToBoughtIdeaUserNotice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostIdeasController extends Controller
{
    //投稿したアイディア表示
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        $categories = Category::get();

        return view('post_idea', compact('categories'));
    }

    //新しいアイディアを投稿する
    public function create(Request $request)
    {
        $request->validate([
            'idea_name' => 'required|string|max:20',
            'summary' => 'required|string|max:100',
            'content' => 'required|string|max:10000',
            'price' => 'required|min:1|digits_between:1,7',
            'category_id' => 'required'
        ]);

        $postidea = new PostIdea;
        $postidea->idea_name = $request->idea_name;
        $postidea->summary = $request->summary;
        $postidea->content = $request->content;
        $postidea->price = $request->price;
        $postidea->post_user_id = auth()->id();
        $postidea->category_id = $request->category_id;
        $postidea->save();

        return redirect('post_idea/' . auth()->user()->id)->with('flash_message', 'アイディアを投稿しました');
    }

    //投稿したアイディア編集画面表示
    public function edit($id)
    {
        if (!ctype_digit($id)) {
            return redirect('post_idea_list/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $postidea = PostIdea::find($id);
        //DBにアイディアのIDが存在するかどうか且つログインユーザーIDとアイディア投稿者IDが一致した場合のみ編集画面を表示する
        if (DB::table('postideas')->where('id', $id)->exists() && auth()->user()->id == $postidea->post_user_id) {
            $categories = Category::get();
            $boughtidea = BoughtIdea::where('idea_id', $id)->first();

            return view('post_idea_edit', compact('postidea', 'categories', 'boughtidea'));
        }else{
            return view('post_idea_edit_error');
        }
    }

    //編集したアイディアの更新
    public function update(Request $request, $id)
    {
        if (!ctype_digit($id)) {
            return redirect('post_idea_edit/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $request->validate([
            'idea_name' => 'required|string|max:20',
            'summary' => 'required|string|max:100',
            'content' => 'required|string|max:10000',
            'price' => 'required|integer',
            'category_id' => 'required'
        ]);

        $postidea = PostIdea::find($id);
        $postidea->idea_name = $request->idea_name;
        $postidea->summary = $request->summary;
        $postidea->content = $request->content;
        $postidea->price = $request->price;
        $postidea->category_id = $request->category_id;
        $postidea->save();

        return redirect('post_idea_list/' . auth()->user()->id)->with('flash_message', 'アイディアを編集しました');
    }


    //アイディア削除
    public function delete($id)
    {
        if (!ctype_digit($id)) {
            return redirect('post_idea_edit/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        PostIdea::find($id)->delete();

        return redirect('post_idea_list/' . auth()->user()->id)->with('flash_message', 'アイディアを削除しました');
    }

    //アイディア詳細画面表示
    public function detail($id)
    {
        if (!ctype_digit($id)) {
            return redirect('post_idea_edit/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        //DBにアイディアのIDが存在する場合、アイディア詳細画面を表示。存在しないIDであればエラー画面表示
        if (DB::table('postideas')->where('id', $id)->exists()) {
            $postidea = PostIdea::find($id);
            $postIdeaUser = $postidea->user()->first();
            $category = $postidea->category()->first();
            $user_id = Auth::user()->id;
            $idea_id = $postidea->id;
            $already_liked = Like::where('user_id', $user_id)->where('idea_id', $idea_id)->first();
            $bought_idea = BoughtIdea::where('buy_user_id', $user_id)->where('idea_id', $id)->first();
            $buy_user_id = optional($bought_idea)->buy_user_id;
            $review = IdeaReview::where('post_idea_id', $id)->where('post_user_id', $user_id)->first();
            $ideaReview = IdeaReview::where('post_idea_id', $id)->with('user')->get();
            $scores = IdeaReview::where('post_idea_id', $id)->selectRaw('AVG(stars) as star')
                ->groupBy('post_idea_id')->first();

            return view('idea_detail', compact('postidea', 'idea_id', 'already_liked', 'postIdeaUser', 'category', 'buy_user_id', 'review', 'ideaReview', 'bought_idea', 'scores'));
        }else{
            return view('idea_detail_error');
        }
    }

    //「気になる」を追加・削除
    public function like(Request $request, $id)
    {
        $postidea = PostIdea::find($id);
        $postIdeaUser = $postidea->user()->first();
        $category = $postidea->category()->first();
        $category_id = $category->id;
        $user_id = Auth::user()->id;
        $idea_id = $postidea->id;
        $already_liked = Like::where('user_id', $user_id)->where('idea_id', $idea_id)->first();
        $bought_idea = BoughtIdea::where('buy_user_id', $user_id)->where('idea_id', $id)->first();
        $buy_user_id = optional($bought_idea)->buy_user_id;
        $review = IdeaReview::where('post_idea_id', $id)->where('post_user_id', $user_id)->first();
        $ideaReview = IdeaReview::where('post_idea_id', $id)->with('user')->get();
        $scores = IdeaReview::where('post_idea_id', $id)->selectRaw('AVG(stars) as star')
            ->groupBy('post_idea_id')->first();


        if (!$already_liked) {
            $like = new Like;
            $like->idea_id = $idea_id;
            $like->user_id = $user_id;
            $like->category_id = $category_id;
            $like->save();
        } else {
            Like::where('idea_id', $idea_id)->where('user_id', $user_id)->delete();
        }
        return view('idea_detail', compact('postidea', 'idea_id', 'already_liked', 'postIdeaUser', 'category', 'buy_user_id', 'review', 'bought_idea', 'ideaReview', 'category_id', 'scores'));
    }

    //アイディアを購入
    public function buy($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $postIdea = PostIdea::find($id);

        $boughtidea = new BoughtIdea;
        $boughtidea->idea_name = $postIdea->idea_name;
        $boughtidea->summary = $postIdea->summary;
        $boughtidea->content = $postIdea->content;
        $boughtidea->price = $postIdea->price;
        $boughtidea->post_user_id = $postIdea->post_user_id;
        $boughtidea->buy_user_id = auth()->id();
        $boughtidea->category_id = $postIdea->category_id;
        $boughtidea->idea_id = $postIdea->id;
        $boughtidea->save();

        $sale_user = $postIdea->user()->first();
        $buy_user = auth()->user();
        Mail::to($sale_user->email)->send(new ToPostIdeaUserNotice($buy_user));
        Mail::to($buy_user->email)->send(new ToBoughtIdeaUserNotice($sale_user));

        return redirect('mypage' . '/' . auth()->user()->id)->with('flash_message', 'アイディアを購入しました。');
    }
}
