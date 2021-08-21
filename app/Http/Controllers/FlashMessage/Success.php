<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\MessageInterface;


class Success implements MessageInterface{

    public function message($messageTypeName, $messageValueToShow)
    {
        return session()->flash($messageTypeName, $messageValueToShow);
    }
}