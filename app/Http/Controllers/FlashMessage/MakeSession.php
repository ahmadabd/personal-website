<?php

namespace App\Http\Controllers\FlashMessage;
    
use App\Http\Controllers\FlashMessage\Message;


class MakeSession implements Message{

    public function message($request, $type, $msg)
    {
        $request->session()->flash($type, $msg);
    }
}