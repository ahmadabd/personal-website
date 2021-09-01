<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\FlashMessage;


class Success implements FlashMessage{

    public function message($messageTypeName, $messageValueToShow)
    {
        return session()->now($messageTypeName, $messageValueToShow);
    }
}