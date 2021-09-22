<?php

namespace App\Http\Controllers\FlashMessage;

use App\Http\Controllers\FlashMessage\Failed;
use App\Http\Controllers\FlashMessage\Success;


class Message{

    private static $messageTypeNames = [
        'success' => Success::class,
        'failed'  => Failed::class
    ];

    function __construct(FlashMessage $message, $messageValueToShow)
    {
        $message->message($messageValueToShow);
    }

    public static function __callStatic($name, $arguments)
    {
        if (!array_key_exists($name, self::$messageTypeNames)){
            dd("{$name} is Invalid method");
        }

        (new Message(new self::$messageTypeNames[$name], $arguments[0]));
    }
}
