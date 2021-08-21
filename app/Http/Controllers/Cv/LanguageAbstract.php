<?php

namespace App\Http\Controllers\Cv;

abstract class LanguageAbstract{
    
    protected $resumeDirectory = "CV";
    
    abstract public function language($resumeFileName) : string; 
}