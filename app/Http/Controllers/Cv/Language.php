<?php

namespace App\Http\Controllers\Cv;

abstract class Language {
    
    protected $resumeDirectory = "CV";
    
    abstract public function language($resumeFileName) : string; 
}