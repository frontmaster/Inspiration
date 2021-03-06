<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeIdeasController extends Controller
{
    public function index()
    {
        $likeIdeas = Auth::user()->Likes()->with('idea', 'category')->paginate(5);

        return $likeIdeas;
    }
}
