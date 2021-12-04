<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostIdeaListsController extends Controller
{
    public function index()
    {
        return \App\PostIdea::all();
    }
}
