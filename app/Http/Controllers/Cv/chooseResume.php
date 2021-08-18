<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Persian;


class chooseResume{
    private $resumeDir = "CV";

    private $langs = [
        'persian' => Persian::class,
    ];

    public function choose($lang, $username)
    {
        if (!array_key_exists($lang, $this->langs)){
            return false;
        }

        $resumePath = (new $this->langs[$lang])->language($lang, $username, $this->resumeDir);
        return $resumePath;
    }

    public static function __callStatic($name, $arguments)
    {
        (new chooseResume)->choose($arguments[0], $arguments[1]);
    }
}