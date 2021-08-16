<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\Message;


class Manage{
    
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;        
    }       

    public function run($request, $type, $msg)
    {
        $this->message->message($request, $type, $msg);        
    }
}
