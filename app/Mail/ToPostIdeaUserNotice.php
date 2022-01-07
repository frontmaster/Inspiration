<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ToPostIdeaUserNotice extends Mailable
{
    use Queueable, SerializesModels;
    public $buy_user;

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
        return $this->subject('あなたのアイディアが購入されました')->view('emails.to_post_idea_user_notice')
        ->with('buy_user', $this->buy_user);
    }
}
