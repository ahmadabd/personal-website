<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


interface Language{
    public function lang($name, $resumeDir);
}

class Persian implements Language{
    public function lang($name, $resumeDir)
    {
        $path = $resumeDir."/persian/";
        $file = $name.".pdf";
        $pathToFile = $path.$file;

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

        $resumeDir = "CV";

        // Get from Database
        $user_name = "Ahmad_Abdollahzadeh";

        // Get language from selectLanguage() method
        // If selectLanguage() result was persian:
        $persian = new Persian;
        $resume = $persian->lang($user_name, $resumeDir);
        $result = response()->file($resume);
                
        
        return $result;
    }
}
