<?php

namespace App\Http\Controllers\Classes;
use App\Http\Controllers\FlashMessage\Message;


class SuccessOrFailMessage {
    public static function SuccessORFail(
            $mood,
            $successMsg = 'mission accomplished.',
            $failedMsg = 'mission failed.'
        )
    {
        ($mood)
        ? self::Success($successMsg)
        : self::Failed($failedMsg);
    }

    public static function Success($msg = 'mission accomplished.')
    {
        Message::success($msg);
    }

    public static function Failed($msg = 'mission failed.')
    {
        Message::failed($msg);
    }
}
