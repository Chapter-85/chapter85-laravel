<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NextApps\VerificationCode\Notifications\VerificationCodeCreatedInterface;
// use App\User;


class EmailVerificationCodeNotification extends Notification implements ShouldQueue, VerificationCodeCreatedInterface
{
    use Queueable;

    /**
     * @var string
     */
    public $code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = User::where('email', $notifiable->routes['mail'])->first();

        return (new MailMessage())
            ->subject(__('Authentication Required'))
            ->greeting(__('Dear ' . $user->name . ','))
            ->line(__("Thank you for registering with MG Metals, Hongkong"))
            ->line(__("Your email verification code is "))
            ->line($this->code)
            ->line(__('Feel free to contact us for any inquiries,'))
            ->line(__('Regards,'))
            ->salutation(__('MG Customer Support Team'));
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
            //
        ];
    }
}
