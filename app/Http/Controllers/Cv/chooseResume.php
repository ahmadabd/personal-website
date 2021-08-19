<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Persian;


class chooseResume{

    private static $langs = [
        'persian' => Persian::class,
    ];

    public function choose($lang, $username)
    {
        $resumePath = (new self::$langs[$lang])->language($lang, $username);

        return $resumePath;
    }

    public static function __callStatic($name, $arguments)
    {
        if (!array_key_exists($name, self::$langs)){
            // return an Exception
            return false;
        }

        return (new chooseResume)->choose($name, $arguments[0]);
    }
}