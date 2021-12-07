<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/')->with('flash_message', '退会手続きが完了しました');
    }

    public function delete_confirm()
    {
        return view('users_delete_confirm');
    }
}
