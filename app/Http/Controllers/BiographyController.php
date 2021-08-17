<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Message;

class BiographyController extends Controller
{

    public function show(Request $request)
    {
        // Get it from Database
        // $bio = "My full-name is Ahmad Abdollahzadeh. I was born in Shahrekord, Iran in 1996.";
        $bio = "";
        
        if ($bio == ""){
            //$message = (new Message)->showMessage("failed", "There is no Biography information.");
            // or
            $message = Message::FailedMessage("failed", "There is no Biography information.");

            $request->$message;
        }

        return view('aboutMe', ['bio' => $bio]);
    }
}
