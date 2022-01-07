<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostIdea extends Model
{
    protected $table =  'postideas';

    protected $fillable = ['category', 'idea_name', 'summary', 'content', 'price'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'post_user_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'id');
    }


    public function reviews()
    {
        return $this->hasMany('App\IdeaReview', 'post_idea_id');
    }

}
