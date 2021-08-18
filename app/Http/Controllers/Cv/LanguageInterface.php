<?php

namespace App\Http\Controllers\Cv;

interface LanguageInterface{
    public function language($lang, $username, $resumeDir) : string;
}