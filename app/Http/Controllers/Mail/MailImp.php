<?php

namespace App\Http\Controllers\Mail;

interface MailImp {
    public function send_mail(string $mail, string $name);
}