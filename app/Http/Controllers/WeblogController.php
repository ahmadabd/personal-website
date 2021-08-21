<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeblogController extends Controller
{
    public function show_weblog_to_client()
    {
        // Get url from DataBase
        $url = "https://virgool.io/@ahmadabd13741112";
        return redirect()->away($url);
    }
}
