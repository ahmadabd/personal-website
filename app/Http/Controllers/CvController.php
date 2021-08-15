<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CvController extends Controller
{
    public function resume()
    {   
        // Get resume from DataBase
        $pathToFile = "CV/Ahmad_Abdollahzadeh.pdf";
        return response()->file($pathToFile);
    }
}
