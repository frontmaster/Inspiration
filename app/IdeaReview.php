<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaReview extends Model
{
    protected $fillable = ['stars', 'comment']; 

    public function user()
    {
        return $this->belongsTo('App\User', 'post_user_id');
    }

    public function idea()
    {
        return $this->belongsTo('App\PostIdea', 'post_idea_id');
    }

}
