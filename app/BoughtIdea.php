<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoughtIdea extends Model
{
    protected $fillable = ['idea_name', 'summary', 'content', 'price'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function buyUser()
    {
        return $this->belongsTo('App\User', 'buy_user_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\IdeaReview', 'idea_id', 'post_idea_id');
        
    }

}
