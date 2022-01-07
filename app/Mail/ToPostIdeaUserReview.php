<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ToPostIdeaUserReview extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($buy_user)
    {
        $this->buy_user = $buy_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('あなたのアイディアにレビューが投稿されました')->view('emails.to_post_idea_user_review')
        ->with('buy_user', $this->buy_user);
    }
}
