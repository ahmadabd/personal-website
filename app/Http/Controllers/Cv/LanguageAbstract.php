<?php

namespace App\Http\Controllers\Cv;

abstract class LanguageAbstract{
    
    protected $resumeDir = "CV";
    
    abstract public function language($lang, $username) : string; 
}