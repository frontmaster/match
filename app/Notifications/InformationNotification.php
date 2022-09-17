<?php

namespace App\Notifications;

use App\ApplyProject;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Notifications\Messages\MailMessage;
use App\Information;





class InformationNotification extends Notification
{
    use Queueable;

    private $information;

    /**
     * Create a new notification instance.
     *
     * @param Information $information;
     */
    public function __construct(Information $information)
    {
        $this->information = $information;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }




    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'date' => $this->information->date,
            'title' => $this->information->title,
            'content' => $this->information->content,
            
        ];
    }
}
