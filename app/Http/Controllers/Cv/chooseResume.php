<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Persian;


class chooseResume{

    private static $langs = [
        'persian' => Persian::class,
    ];

    public function choose($lang, $username)
    {
        if (!array_key_exists($lang, self::$langs)){
            return false;
        }

        $resumePath = (new self::$langs[$lang])->language($lang, $username);

        return $resumePath;
    }

    public static function __callStatic($name, $arguments)
    {
        if (!array_key_exists($name, self::$langs)){
            return false;
        }

        return (new chooseResume)->choose($name, $arguments[0]);
    }
}