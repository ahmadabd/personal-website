<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotificationMail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    public function __construct($details)
    {
        $this->details = $details;
    }


    public function handle()
    {
        $email = $this->details["email"];
        $data = $this->details["data"];

        Mail::to($email)->send(new LoginNotificationMail($data));
    }
}
