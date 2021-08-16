<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Manage;
use App\Http\Controllers\FlashMessage\MakeSession;


class BiographyController extends Controller
{

    public function show(Request $request)
    {
        // Get it from Database
        // $bio = "My full-name is Ahmad Abdollahzadeh. I was born in Shahrekord, Iran in 1996.";
        $bio = "";
        
        if ($bio == ""){
            $failed = new MakeSession;
            $flashMessage = new Manage($failed);
            $flashMessage->run($request, "failed", "There is no Biography information.");
        }

        return view('aboutMe', ['bio' => $bio]);
    }
}
