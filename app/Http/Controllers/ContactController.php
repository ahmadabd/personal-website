<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Manage;
use App\Http\Controllers\FlashMessage\MakeSession;


class ContactController extends Controller
{
    public function show(Request $request)
    {
        // Get it from Database
        // $contact = "phone: 123465";
        $contact = "";

        if ($contact == ""){
            $failed = new MakeSession;
            $flashMessage = new Manage($failed);
            $flashMessage->run($request, "failed", "There is no Contact information.");
        }

        return view('contactMe', ['contact' => $contact]);   
    }
}
