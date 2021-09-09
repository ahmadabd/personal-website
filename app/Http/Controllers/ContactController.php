<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\ContactMeRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Classes\ContactClass;


class ContactController extends Controller
{

    private $contactMeList = [
        'email'     => null, 
        'linkedin'  => null, 
        'twitter'   => null, 
        'instagram' => null, 
        'github'    => null, 
        'telegram'  => null
    ];

    private $icons = [
        'linkedin'  => 'entypo-linkedin-with-circle',
        'email'     => 'gmdi-email',
        'telegram'  => 'forkawesome-telegram',
        'instagram' => 'fab-instagram-square',
        'twitter'   => 'antdesign-twitter-circle',
        'github'    => 'bytesize-github'
    ];


    public function show_contactMe_to_client()
    {
        /**
         * Show ContactMe data to clients
         */

        $contactMeLinks = [];

        if (Contact::exists()){
            // Get data from database

            $contact = Contact::get()[0];

            foreach ($this->icons as $icon){
                $contactMeKey = array_keys($this->icons, $icon)[0];
                if ($contact->$contactMeKey){
                    $contactMeLinks[$contactMeKey] = [$icon, $contact->$contactMeKey];
                }
            }
        }
        if (count($contactMeLinks) == 0) {
            // We want to show failed message for when null stored contactMe 
            Message::failed("There is no Contact information.");
        }

        return view('contactMe', ['contactLinks' => $contactMeLinks]);   
    }


    public function show_contactMe_edit()
    {
        /**
         * Get data from database to show as value in input tag if exist 
         */ 

        $contacts = Auth::user()->contact();
        
        if ($contacts->exists()){
            $contactMe = $contacts->get()[0];

            $this->contactMeList['email']     = $contactMe->email;
            $this->contactMeList['linkedin']  = $contactMe->linkedin;
            $this->contactMeList['twitter']   = $contactMe->twitter;
            $this->contactMeList['instagram'] = $contactMe->instagram;
            $this->contactMeList['github']    = $contactMe->github;
            $this->contactMeList['telegram']  = $contactMe->telegram;
        }

        return view('contactMe_edit', ["values" => $this->contactMeList]);
    }


    public function store_contactMe(ContactMeRequest $request)
    {   
        /** 
         * Value of input lists should not be same
         */

        $validated = $request->validated();
        $contact = Auth::user()->contact();

        // store validated data as value in this->contactMeList array
        foreach($validated as $contactWay){
            $validatedKey = array_keys($validated, $contactWay)[0];             
            $this->contactMeList[$validatedKey] = $contactWay;
        }

        // Update Contact Model if there are stored value in DataBase else Create new Contact Model
        $storedContact = ($contact->exists())
            ? ContactClass::update($contact, $this->contactMeList)
            : ContactClass::create($contact, $this->contactMeList);

        // if storedContact == true Send Success else send Failed Message
        ($storedContact) 
        ? Message::success("Data successfully stored.")
        : Message::failed("Cant store data.");
        
        return redirect()->route('show_contactMe_edit');
    }
}
