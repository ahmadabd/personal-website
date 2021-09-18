<?php

namespace App\Http\Controllers\FlashMessage;

use App\Http\Controllers\FlashMessage\FlashMessage;


class Failed implements FlashMessage{

    private $messageTypeName = "failed";

    public function message($messageValueToShow)
    {
        return session()->flash($this->messageTypeName, $messageValueToShow);
    }
}
