<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_img', 'comment'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function PostIdeas()
    {
        return $this->hasMany('App\PostIdea', 'post_user_id');   
    }

    public function Likes()
    {
        return $this->hasMany('App\Like', 'user_id');
    }

    public function BoughtIdeas()
    {
        return $this->hasMany('App\BoughtIdea', 'buy_user_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\IdeaReview', 'to_user_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($user){

            $user->PostIdeas()->delete();
        });
    }

    
}
