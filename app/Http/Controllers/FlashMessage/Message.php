<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\Failed;
use App\Http\Controllers\FlashMessage\Success;


class Message{
    
    private static $classes = [
        'success' => Success::class,
        'failed'  => Failed::class 
    ];

    public function showMessage($type, $msg)
    {
        $class = new self::$classes[$type];
     
        return $class->message($type, $msg);
    }

    public static function __callStatic($name, $arguments)
    {
        if (!array_key_exists($name, self::$classes)){
            // return an Exception
            return false;
        }

        return (new Message)->showMessage($name, $arguments[0]);
    }
}
