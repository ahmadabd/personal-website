<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from('personalwebsite.checklogin@gmail.com')
                    ->subject('Login to personal_website')
                    ->view('emails.LoginNotify')
                    ->with('data', $this->data);
    }
}
