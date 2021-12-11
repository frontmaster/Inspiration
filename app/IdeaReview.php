<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeaReview extends Model
{
    protected $fillable = ['stars', 'score', 'comment']; 

    public function user()
    {
        return $this->belongsTo('App\User', 'post_user_id');
    }
}
