<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeblogController extends Controller
{
    public function show_weblog_to_client()
    {
        // Get weblog address from DataBase
        $weblogAddress = "https://virgool.io/@ahmadabd13741112";

        if (! $weblogAddress ){
            abort(404);
        }

        return redirect()->away($weblogAddress);
    }
}
