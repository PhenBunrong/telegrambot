<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Telegram\TelegramFile;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramMessage;


class SendNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
   {
      return TelegramFile::create()
          ->to('-863483806') // Optional.
          ->content(
                    "*Stage : Deploy indication-plus"."*\n".
                    "*Branch : ".$notifiable->email."*\n".
                    "*Environment  : hotfix"."*\n".
                    "*User Build : ".$notifiable->name."*\n".
                    "*Application URL : https://hotfix.vtrustappraisal.com/"."*\n"
          )
          ->photo('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRGXo6avhXeV8CGK-47aCVxRlbwTVd69o85h8ocvkpF&s');



        //   ->photo('https://bdc2020.o0bc.com/wp-content/uploads/2018/02/Behind_the_Wheel_Manual_Transmission_80218-scaled.jpg'); // Markdown supported.
        //   ->button('View Detail', 'https://addlist.co.id'); // Inline Button
   }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
