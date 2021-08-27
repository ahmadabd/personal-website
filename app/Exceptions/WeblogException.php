<?php

namespace App\Exceptions;

use Exception;

class WeblogException extends Exception
{
    public function report(){}

    public function render()
    {
        return view('errors.Weblog_not_found');
    }
}
