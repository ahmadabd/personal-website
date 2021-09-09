<?php

namespace App\Http\Controllers\Mail;

use App\Jobs\SendMail;

class LoginNotify implements MailImp{
    public function send_mail(string $name, string $email){
        $date = date("Y/m/d H:i:s");
        $data = array( 'name' => $name, 'date' => $date );
        
        $details = array(
            "email" => $email,
            "data"  => $data
        );

        SendMail::dispatch($details)->delay(5);
    }
}