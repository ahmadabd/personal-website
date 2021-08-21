<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Cv\chooseResume;


class CvController extends Controller
{
    public function selectLanguage()
    {
        # Show page to Select between language do you need to see resume??? 
    }
    

    public function show_resume_to_client(Request $request)
    {   
        // Get resume from DataBase


        // Remove it by storing resume by hash named
        $resumeName = "Ahmad_Abdollahzadeh";

        // Get language from selectLanguage() method
        $resumeAddress = chooseResume::persian($resumeName);

        $resumeFile = response()->file($resumeAddress);
                
        return $resumeFile;
    }
}
