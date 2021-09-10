<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\BiographyRequest;
use App\Models\Bio;
use App\Http\Controllers\Classes\BiographyStoreClass;
use Illuminate\Support\Facades\Auth;


class BiographyController extends Controller
{

    public function show_biography_to_client()
    {
        /**
         * Show biography to clients
         */

        $biography = "";

        if (!Bio::exists() || !Bio::get()[0]->biography){
            // If there is no Biography stored or biography field is null make a failed message
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
        $bio = Auth::user()->bio();
        
        if ($bio->exists()){
            // Get biography from DB
            $biography = $bio->get()[0]->biography;
        }

        return view('dashboard', ["biography" => $biography]);
    }


    public function store_biography(BiographyRequest $request)
    {
        /**
         * Store or Update new biography
         */
        $biography = $request->validated()["biography"];
        $bio = Auth::user()->bio();

        // Update bio Model if there are stored value in DataBase else Create
        $storedBio = ($bio->exists()) 
        ? BiographyStoreClass::update($bio, $biography)
        : BiographyStoreClass::create($bio, $biography);

        // if data has successfully stored in DB Send Success else send Failed Message
        ($storedBio)
        ? Message::success("Biography Successfully Changed.")
        : Message::failed("Biography cant store in DataBase.");
        
        return redirect()->route('edit_biography');
    }
}
