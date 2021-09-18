<?php

namespace App\Http\Controllers\FlashMessage;

use App\Http\Controllers\FlashMessage\FlashMessage;


class Success implements FlashMessage{

    private $messageTypeName = "success";

    public function message($messageValueToShow)
    {
        return session()->flash($this->messageTypeName, $messageValueToShow);
    }
}
