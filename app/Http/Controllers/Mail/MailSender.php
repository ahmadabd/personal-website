<?php

namespace App\Http\Controllers\Mail;
use App\Http\Controllers\Mail\LoginNotify;
use Exception;

class MailSender {
    private static $MailClasses = [
        'LoginNotify' => LoginNotify::class
    ];


    function __construct(MailImp $mail, $name, $email)
    {
        try {
            return $mail->send_mail($name, $email);
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

        return (new MailSender(new self::$MailClasses[$name], $arguments[0], $arguments[1]));
    }
}
