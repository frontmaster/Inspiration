<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassChangeCompleteController extends Controller
{
    //新しいパスワードへの変更完了通知画面表示
    public function index()
    {
        return view('PassChangeComplete');
    }
}
