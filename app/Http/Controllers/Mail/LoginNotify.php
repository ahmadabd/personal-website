<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotificationMail;

class LoginNotify implements MailImp{
    public function send_mail(string $name, string $email){
        $date = date("Y/m/d H:i:s");
        $data = array( 'name' => $name, 'date' => $date );
        
        Mail::to($email)->queue(new LoginNotificationMail($data));
    }
}