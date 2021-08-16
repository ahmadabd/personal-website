<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Include FlashMessage.php file
include "FlashMessages/FlashMessage.php";
use FlashMessage\Manage as FlashMessage;


class BiographyController extends Controller
{
    public function show(Request $request)
    {
        // Get it from Database
        $bio = "My full-name is Ahmad Abdollahzadeh. I was born in Shahrekord, Iran in 1996.";

        if ($bio == ""){
            new FlashMessage($request, "failed", "There is no Registered biography.");
        }

        return view('aboutMe', ['bio' => $bio]);
    }
}
