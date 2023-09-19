<?php

namespace App\Notifications;

use App\Mail\UserAccountMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class UserAccountNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly User $user, private readonly array $data = [])
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // https://laravel.com/docs/10.x/queues#supervisor-configuration
        //if($notifiable instanceof User && $notifiable->accept_mail){
        //    return ['mail', 'database'];
        //}
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return new UserAccountMail($this->user, $this->data);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => (isset($this->data['title']) && !empty($this->data['title'])) ? $this->data['title'] : '',
            'message' => (isset($this->data['message']) && !empty($this->data['message'])) ? $this->data['message'] : '',
            ...$this->user->withoutRelations()->toArray(),
            ...$this->data
        ];
    }
}
