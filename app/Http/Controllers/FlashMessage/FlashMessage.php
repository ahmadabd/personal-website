<?php

namespace App\Http\Controllers\FlashMessage;

interface FlashMessage{
    public function message($messageTypeName, $messageValueToShow);
}
    