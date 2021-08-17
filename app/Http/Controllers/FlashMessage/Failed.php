<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\MessageInterface;


class Failed implements MessageInterface{

    public function message($type, $msg)
    {
        return session()->flash($type, $msg);
    }
}