<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Message;


class ContactController extends Controller
{
    public function show(Request $request)
    {
        // Get it from Database
        // $contact = "phone: 123465";
        $contact = "";

        if ($contact == ""){
            //$message = (new Message)->showMessage("failed", "There is no Contact information.");
            // or
            $message = Message::failed("There is no Contact information.");
            
            $request->$message;
        }

        return view('contactMe', ['contact' => $contact]);   
    }
}
