<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\Failed;
use App\Http\Controllers\FlashMessage\Success;


class Message{
    
    private $classes = [
        'success' => Success::class,
        'failed'  => Failed::class 
    ];

    public function showMessage($type, $msg)
    {
        if(!array_key_exists($type, $this->classes)){
            return false;
        }
        $class = new $this->classes[$type];
        return $class->message($type, $msg);
    }

    public static function __callStatic($name, $arguments)
    {
        return (new Message)->showMessage($arguments[0], $arguments[1]);
    }
}
