<?php

namespace NotificationChannels\Signal;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use NotificationChannels\Signal\Exceptions\CouldNotSendNotification;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SignalChannel
{
    /**
    * Signal instance
    * @var Signal
    **/
    protected $signal;

    /**
    * Send the given notification.
    *
    * @param mixed $notifiable
    * @param \Illuminate\Notifications\Notification $notification
    *
    * @throws \NotificationChannels\Signal\Exceptions\CouldNotSendNotification
    */

    public function send($notifiable, Notification $notification)
    {
        $collection = collect($notification->toSignal($notifiable));

        $recipient  = $collection->get('recipient');
        $group      = $collection->get('group');
        $message    = $collection->get('message');
        $username    = $collection->get('username');
        $attachment    = $collection->get('attachment');


        $command = [
            config('signal-notification-channel.signal_cli'),
            '--username',  $username,
            'send'
        ];

        if ($message){
            $command[] = '--message';
            $command[] = $message;

        }

        if ($attachment){
            $command[] = '-a';
            $command[] = $attachment;
        }

        // Send to group if group is provided
        // Else send to single recipient
        if ($group){
            $command[] = '--group';
            $command[] = $group;
        } else {
            $command[] = $recipient;
        }


        //Run signal-cli via Symfony Process.
        $result = new Process(
            $command,
            null,
            //Pass JAVA_HOME to Symfony so signal-cli can run.
            ['JAVA_HOME' => config('signal-notification-channel.java_location')]
        );

        $result->run();

        if (!$result->isSuccessful()) {
          throw new ProcessFailedException($result);
        }

        return $result;
    }
}
