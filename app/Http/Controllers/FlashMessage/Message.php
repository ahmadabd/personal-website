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
        return $message->message($messageValueToShow);
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected MessageType is not in $messageTypeNames return an Exception
        if (!array_key_exists($name, self::$messageTypeNames)){

            dd("{$name} is Invalid method");
        }

        return (new Message(new self::$messageTypeNames[$name], $arguments[0]));
    }
}
