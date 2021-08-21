<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\LanguageAbstract;


class Persian extends LanguageAbstract{

    private $persianDirectory = "/persian/";

    public function language($resumeName) : string
    {
        $resumeDirectoryAddress = $this->resumeDirectory.$this->persianDirectory;
        $file = $resumeName.".pdf";
        $resumeFileAddress = $resumeDirectoryAddress.$file;
        
        return $resumeFileAddress;
    }
}   