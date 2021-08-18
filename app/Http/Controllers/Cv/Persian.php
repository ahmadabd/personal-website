<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\LanguageAbstract;


class Persian extends LanguageAbstract{

    private $persianDir = "/persian/";

    public function language($lang, $username) : string
    {
        $path = $this->resumeDir.$this->persianDir;
        $file = $username.".pdf";
        $resumePath = $path.$file;
        return $resumePath;
    }
}   