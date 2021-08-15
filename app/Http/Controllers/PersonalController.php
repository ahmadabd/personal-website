<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function weblog()
    {
        // Get url from DataBase
        $url = "https://virgool.io/@ahmadabd13741112";
        return redirect()->away($url);
    }

    public function resume()
    {   
        // Get resume from DataBase
        $pathToFile = "CV/Ahmad_Abdollahzadeh.pdf";
        return response()->file($pathToFile);
    }
}
