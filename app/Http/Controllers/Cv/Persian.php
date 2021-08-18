<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\LanguageInterface;


class Persian implements LanguageInterface{

    private $persianDir = "/persian/";

    public function language($lang, $username, $resumeDir) : string
    {
        $path = $resumeDir.$this->persianDir;
        $file = $username.".pdf";
        $resumePath = $path.$file;
        return $resumePath;
    }
}   