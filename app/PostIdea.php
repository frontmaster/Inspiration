<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostIdea extends Model
{
    protected $table =  'postideas';
    
    protected $fillable = ['category', 'idea_name', 'summary', 'content', 'price']; 
}
