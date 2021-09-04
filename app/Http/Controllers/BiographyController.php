<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\BiographyRequest;
use App\Models\Bio;

use Illuminate\Support\Facades\Auth;


class BiographyController extends Controller
{

    public function show_biography_to_client()
    {
        /**
         * Show biography to clients
         */

        $biography = "";

        if (!Bio::exists()){
            // If there is no Biography stored in DataBase make a failed message
            Message::failed("There is no Biography information.");       
        }
        else{
            // Get biography from DataBase
            $biography = Bio::get()[0]->biography;
        }

        return view('aboutMe', ['bio' => $biography]);
    }


    public function show_biography_editPage()
    {
        /**
         * Get biography from DB and send it to dashboard view (biography_edit_page)
         */
        $biography = "";
        $bioObj = Auth::user()->bio();
        
        if ($bioObj->exists()){
            // Get biography from DB
            $biography = $bioObj->get()[0]->biography;
        }

        return view('dashboard', ["biography" => $biography]);
    }


    public function store_biography(BiographyRequest $request)
    {
        /**
         * Store or Update new biography
         */
        $biography = $request->validated()["biography"];
        $bioObject = Auth::user()->bio();

        if ($bioObject->exists()){
            // Update last biography
            $bioObject->update([
                'biography' => $biography,
            ]);
        }
        else{
            // Store new biography
            $bioObject->create([
                'biography' => $biography,
            ]);    
        }

        Message::success("Biography Successfully Changed.");
        
        return redirect()->route('edit_biography');
    }
}
