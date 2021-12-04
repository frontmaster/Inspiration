<?php

namespace App\Http\Controllers;

use App\Category;
use App\PostIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostIdeasController extends Controller
{
    public function index($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        $categories = Category::get();

        return view('post_idea', compact('categories'));
    }

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

    public function edit($id)
    {
        if (!ctype_digit($id)) {
            return redirect('post_idea_list/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        
        $postidea = PostIdea::find($id);
        $categories = Category::get();

        return view('post_idea_edit', compact('postidea', 'categories'));
    }

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
}
