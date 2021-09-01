<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\FlashMessage;


class Failed implements FlashMessage{

    public function message($messageTypeName, $messageValueToShow)
    {
        return session()->now($messageTypeName, $messageValueToShow);
    }
}