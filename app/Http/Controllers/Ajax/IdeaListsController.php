<?php

namespace App\Http\Controllers\Ajax;

use App\PostIdea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IdeaListsController extends Controller
{
    public function index()
    {
        $ideaLists = PostIdea::with('category', 'reviews')->paginate(5);

        return $ideaLists;
    }
}
