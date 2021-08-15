<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


interface Language{
    public function lang($name);
}

class Persian implements Language{
    public function lang($name)
    {
        $path = "CV/persian";
        $file = $name.".pdf";
        $pathToFile = "CV/persian/".$file;

    }
}

class CvController extends Controller
{
    public function selectLanguage()
    {
        # Show page to Select between language do you need to see resume??? 
    }
    

    public function getResume(Request $request)
    {   
        // Get resume from DataBase

        // Get language from selectLanguage() method
        // If selectLanguage() result was persian:
        $persian = new Persian;
        $resume = $persian->lang("Ahmad_Abdollahzadeh");
        $result = response()->file($resume);
                
        
        return $result;
    }
}
