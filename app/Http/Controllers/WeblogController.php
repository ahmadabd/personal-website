<?php

namespace App\Http\Controllers;

use App\Exceptions\WeblogException;
use Illuminate\Http\Request;

class WeblogController extends Controller
{
    public function show_weblog_to_client()
    {
        // Get weblog address from DataBase
        $weblogAddress = "https://virgool.io/@ahmadabd13741112";

        try{
            return redirect()->away($weblogAddress);
        } catch(\Exception $exception){
            throw new WeblogException();
        }
    }
}
