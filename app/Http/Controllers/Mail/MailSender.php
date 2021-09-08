<?php

namespace App\Http\Controllers\Mail;
use App\Http\Controllers\Mail\LoginNotify;
use Exception;

class MailSender {
    private static $MailClasses = [
        'LoginNotify' => LoginNotify::class
    ];

    public function choose_class($mailClass, $name, $email)
    {
        try {
            return (new self::$MailClasses[$mailClass])->send_mail($name, $email);
        }
        catch (Exception $e){
            // Dont show error if email cant send
            return $e;
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if (!array_key_exists($name, self::$MailClasses)){

            dd("{$name} class dosent exists.");
        }

        return (new MailSender)->choose_class($name, $arguments[0], $arguments[1]);
    }
}