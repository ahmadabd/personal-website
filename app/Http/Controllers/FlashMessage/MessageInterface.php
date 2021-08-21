<?php

namespace App\Http\Controllers\FlashMessage;

interface MessageInterface{
    public function message($messageTypeName, $messageValueToShow);
}
    