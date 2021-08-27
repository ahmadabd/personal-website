<?php

namespace App\Exceptions;

use Exception;

class ResumeException extends Exception
{
    public function report(){}

    public function render()
    {
        return view('errors.Resume_not_found');
    }
}
