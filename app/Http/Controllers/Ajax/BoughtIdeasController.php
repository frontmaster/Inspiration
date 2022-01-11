<?php

namespace App\Http\Controllers\Ajax;

use App\BoughtIdea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BoughtIdeasController extends Controller
{
    public function index()
    {
        $boughtIdeaLists = Auth::user()->BoughtIdeas()->with('category')->paginate(5);

        return $boughtIdeaLists;
    }
}
