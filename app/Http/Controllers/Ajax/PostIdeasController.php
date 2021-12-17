<?php

namespace App\Http\Controllers\Ajax;

use App\PostIdea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostIdeasController extends Controller
{
    public function index($id)
    {
        return PostIdea::find($id)->with('category', 'user')->get();
    }
}
