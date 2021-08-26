<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Persian;


class chooseResume{

    private static $resumeLanguages = [
        'persian_resume' => Persian::class,
    ];

    private function choose_resume_language($selectedLanguage)
    {
        // Call language method of the Selected Language Class
        $resumeDirectoryAddress = (new self::$resumeLanguages[$selectedLanguage])->language();

        return $resumeDirectoryAddress;
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected language is not in $resumeLanguages return an Error
        if (!array_key_exists($name, self::$resumeLanguages)){
            
            dd("{$name} is Invalid method");
        }

        return (new chooseResume)->choose_resume_language($name);
    }
}