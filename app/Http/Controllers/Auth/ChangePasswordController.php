<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'new_password' => 'required|string|min:8|confirmed',
        ]);
    }

    public function edit($id)
    {
        $users = Auth::user($id);
        return view('auth.passwords.edit', compact('users'));
    }

    public function update(Request $request)
    {
        //不正操作のチェック
        if ($request->id != auth()->user()->id) {
            return redirect('mypage/' . auth()->user()->id)
                ->with('flash_message', '不正な操作が行われました');
        }

        $users = Auth::user();

        //現在のパスワードを確認
        if (!password_verify($request->old_password, $users->password)) {
            return redirect('/password/change/' .auth()->user()->id)
                ->with('flash_message', 'パスワードが違います');
        }

        $this->validator($request->all())->validate();

        $users->password = bcrypt($request->new_password);
        $users->save();

        return redirect('/')->with('flash_message', 'パスワードを変更しました');
        
    }
}
