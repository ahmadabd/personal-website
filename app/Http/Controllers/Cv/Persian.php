<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Language;


class Persian extends Language{

    private $persianDirectory = "/persian/";

    public function language($resumeName) : string
    {
        $resumeDirectoryAddress = $this->resumeDirectory.$this->persianDirectory;
        $file = $resumeName.".pdf";
        $resumeFileAddress = $resumeDirectoryAddress.$file;
        
        return $resumeFileAddress;
    }
}   