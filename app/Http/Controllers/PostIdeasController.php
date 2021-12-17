<?php

namespace App\Http\Controllers;

use App\Like;
use App\Category;
use App\PostIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'price' => 'required|integer',
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

        return redirect('/post_idea' . '/' . auth()->user()->id)->with('flash_message', 'アイディアを投稿しました');
    }

    //投稿したアイディア編集画面表示
    public function edit($id)
    {
        if (!ctype_digit($id)) {
            return redirect('post_idea_list/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $postidea = PostIdea::find($id);
        $categories = Category::get();

        return view('post_idea_edit', compact('postidea', 'categories'));
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


    //アイディア削除実行
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

        $ideaDetail = PostIdea::find($id);
        $postIdeaUser = $ideaDetail->user()->first();
        $category = $ideaDetail->category()->first();
        $userIdea = Auth::user()->PostIdeas($id)->first();
        $user_id = Auth::user()->id;
        $idea_id = $userIdea->id;
        $already_liked = Like::where('user_id', $user_id)->where('idea_id', $idea_id)->first();

        return view('idea_detail', compact('ideaDetail', 'already_liked', 'userIdea', 'postIdeaUser', 'category'));
    }

    //「気になる」を追加
    public function like(Request $request, $id)
    {
        $ideaDetail = PostIdea::find($id);
        $postIdeaUser = $ideaDetail->user()->first();
        $category = $ideaDetail->category()->first();
        $userIdea = Auth::user()->PostIdeas($id)->first();
        $user_id = Auth::user()->id;
        $idea_id = $userIdea->id;
        $already_liked = Like::where('user_id', $user_id)->where('idea_id', $idea_id)->first();
        

        if(!$already_liked){
            $like = new Like;
            $like->idea_id = $idea_id;
            $like->user_id = $user_id;
            $like->save();
        }else{
            Like::where('idea_id', $idea_id)->where('user_id', $user_id)->delete();
        }
        return view('idea_detail', compact('ideaDetail', 'already_liked' , 'userIdea', 'postIdeaUser', 'category'));

    }
}
