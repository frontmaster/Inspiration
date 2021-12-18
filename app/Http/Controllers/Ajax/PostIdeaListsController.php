<?php

namespace App\Http\Controllers\Ajax;

use App\PostIdea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostIdeaListsController extends Controller
{
    public function index()
    {
        $postIdeaLists = Auth::user()->PostIdeas()->with('category', 'user')->paginate(1);
        
        return $postIdeaLists;
    }
}
