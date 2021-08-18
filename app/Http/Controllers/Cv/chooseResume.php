<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Persian;


class chooseResume{

    private $langs = [
        'persian' => Persian::class,
    ];

    public function choose($lang, $username)
    {
        if (!array_key_exists($lang, $this->langs)){
            return false;
        }

        $resumePath = (new $this->langs[$lang])->language($lang, $username);

        return $resumePath;
    }

    public static function __callStatic($name, $arguments)
    {
        return (new chooseResume)->choose($arguments[0], $arguments[1]);
    }
}