<?php

namespace App\Http\Controllers\FlashMessage;

interface MessageInterface{
    public function message($type, $msg);
}
    