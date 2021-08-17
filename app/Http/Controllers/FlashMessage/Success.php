<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\MessageInterface;


class Success implements MessageInterface{

    public function message($type, $msg)
    {
        return session()->flash($type, $msg);
    }
}