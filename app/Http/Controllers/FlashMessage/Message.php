<?php

namespace App\Http\Controllers\FlashMessage;

interface Message{
    public function message($request, $type, $msg);
}
    