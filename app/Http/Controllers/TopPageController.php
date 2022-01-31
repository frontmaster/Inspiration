<?php

namespace App\Http\Controllers;

use App\PostIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopPageController extends Controller
{
    public function index()
    {
        
        $postIdeaLists = PostIdea::orderBy('created_at', 'DESC')->take(12)->get();

        return view('welcome', compact('postIdeaLists'));
    }
}
