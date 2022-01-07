<?php

namespace App\Http\Controllers\Ajax;

use App\IdeaReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ReviewsController extends Controller
{
    public function index() 
    {
        $reviews = IdeaReview::with('user', 'idea')->get();

        return $reviews;
    }
}
