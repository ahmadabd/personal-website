<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Include FlashMessage.php file
include "Modules/FlashMessage.php";
use FlashMessage\Manage as FlashMessage;


class ContactController extends Controller
{
    public function show(Request $request)
    {
        // Get it from Database
        $contact = "";

        if ($contact == ""){
            new FlashMessage($request, "failed", "There is no Contact information.");
        }

        return view('contactMe', ['contact' => $contact]);   
    }
}
