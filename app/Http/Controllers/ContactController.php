<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Message;


class ContactController extends Controller
{
    public function show_contactMe_to_client(Request $request)
    {
        // Get it from Database
        // $contact = "phone: 123465";
        $contactMe = "";

        if ($contactMe == ""){
            
            $message = Message::failed("There is no Contact information.");
            
            $request->$message;
        }

        return view('contactMe', ['contact' => $contactMe]);   
    }
}
