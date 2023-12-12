<?php

namespace App\Channels;

use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {
//        return 'OK';

        $receptor = $notifiable->cellphone;
        $template = 'otp';
        GhasedakFacade::setVerifyType(GhasedakFacade::VERIFY_MESSAGE_TEXT)
            ->Verify(
                $receptor,
                $template,
                $notification->code,
            );
    }
}
