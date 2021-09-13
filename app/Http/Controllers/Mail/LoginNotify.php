<?php

namespace App\Http\Controllers\Mail;

use App\Jobs\SendMail;
//use Illuminate\Support\Facades\Mail;
//use App\Mail\LoginNotificationMail;

class LoginNotify implements MailImp{
    public function send_mail(string $name, string $email){
        $date = date("Y/m/d H:i:s");
        $data = array( 'name' => $name, 'date' => $date );
        
        $details = array(
            "email" => $email,
            "data"  => $data
        );

        // Using job
        SendMail::dispatch($details)->delay(5);
        
        // Using Laravel Queue Facade
        //Mail::to($email)->queue(new LoginNotificationMail($data));
    }
}