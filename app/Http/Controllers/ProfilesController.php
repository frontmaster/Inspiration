<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function edit($id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }
        $users = Auth::user($id);
        return view('profile', compact('users'));
    }

    public function update(Request $request, $id)
    {
        if (!ctype_digit($id)) {
            return redirect('mypage/' . auth()->user()->id)->with('flash_message', '不正な操作が行われました');
        }

        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|string|max:255',
            'user_img' => 'max:1024|mimes:jpg,jpeg,png,gif',
            'comment' => 'max:10000',
        ]);

        $users = User::find($id);

        if ($request and $request->user_img != null) {
            $users->name = $request->name;
            $users->email = $request->email;
            $users->user_img = $request->user_img->store('public/image');
            $users->comment = $request->comment;
            $users->save();
            return redirect('/profile' . '/' . $users->id)->with('flash_message', 'プロフィールを編集しました');
        } elseif ($request and $request->user_img == null) {
            $users->fill($request->all())->save();
            return redirect('/profile' . '/' . $users->id)->with('flash_message', 'プロフィールを編集しました');
        }
    }
}
