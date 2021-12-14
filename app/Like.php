<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function idea()
    {
        return $this->belongsTo('App\PostIdea', 'idea_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
