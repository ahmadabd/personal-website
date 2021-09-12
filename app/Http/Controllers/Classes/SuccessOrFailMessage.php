<?php

namespace App\Http\Controllers\Classes;
use App\Http\Controllers\FlashMessage\Message;


class SuccessOrFailMessage {
    public static function SuccessORFail($mood)
    {
        ($mood)
        ? self::Success()
        : self::Failed();
    }

    public static function Success()
    {
        Message::success('mission accomplished.');
    }
    
    public static function Failed()
    {
        Message::failed('mission failed.');
    }
}