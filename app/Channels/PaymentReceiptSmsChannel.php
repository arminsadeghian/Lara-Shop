<?php

namespace App\Channels;

use App\Models\User;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Notifications\Notification;

class PaymentReceiptSmsChannel
{
    public function send($notifiable, Notification $notification)
    {
        $receptor = $notifiable->cellphone;
        $template = 'PaymentReceipt';
        GhasedakFacade::setVerifyType(GhasedakFacade::VERIFY_MESSAGE_TEXT)
            ->Verify(
                $receptor,
                $template,
                $notification->refId,
            );
    }
}
