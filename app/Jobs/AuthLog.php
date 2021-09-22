<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;


class AuthLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public function __construct($details)
    {
        $this->details = $details;
    }


    public function handle()
    {
        $ip = $this->details["ip"];
        $routeName = $this->details["routeName"];

        Log::channel('routeAccess')->warning("Ip: {$ip} Checked {$routeName}");
    }
}
