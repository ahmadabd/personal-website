<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\Failed;
use App\Http\Controllers\FlashMessage\Success;


class Message{
    
    private static $messageTypeNames = [
        'success' => Success::class,
        'failed'  => Failed::class 
    ];

    private function showMessage($messageTypeName, $messageValueToShow)
    {
        // Call message method of the Selected Message Class
        $sessionObjectOfMessage = (new self::$messageTypeNames[$messageTypeName])->message($messageTypeName, $messageValueToShow);
        
        return $sessionObjectOfMessage;
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected MessageType is not in $messageTypeNames return an Exception
        if (!array_key_exists($name, self::$messageTypeNames)){
            // return an Exception
            return false;
        }

        return (new Message)->showMessage($name, $arguments[0]);
    }
}
