<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Sentinel;

class NewPostNotification extends Notification
{
    use Queueable;

    protected $post;


    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable){
        return [
            'post' => $this->post,
            'user' => Sentinel::getUser($this->post->user->id)
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
