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
    

    public function getResume(Request $request)
    {   
        // Get resume from DataBase


        // Get from Database
        $user_name = "Ahmad_Abdollahzadeh";

        // Get language from selectLanguage() method
        $resume = chooseResume::persian($user_name);

        $result = response()->file($resume);
                
        return $result;
    }
}
