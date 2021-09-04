<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\ContactMeRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


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

        $contactLinks = [];

        if (Contact::exists()){
            // Get data from database

            $databseValues = Contact::get()[0];

            foreach ($this->icons as $icon){
                $contactName = array_keys($this->icons, $icon)[0];
                if ($databseValues[$contactName]){
                    $contactLinks[$contactName] = [$icon, $databseValues[$contactName]];
                }
            }
        }
        if (count($contactLinks) == 0) {
            // We want to show failed message for when null stored contactMe 
            Message::failed("There is no Contact information.");
        }

        return view('contactMe', ['contactLinks' => $contactLinks]);   
    }


    public function show_contactMe_edit()
    {
        /**
         * Get data from database to show as value in input tag if exist 
         */ 

        $contactsObject = Auth::user()->contact();
        
        if ($contactsObject->exists()){
            $databseValues = $contactsObject->get()[0];

            $this->contactMeList['email']     = $databseValues->email;
            $this->contactMeList['linkedin']  = $databseValues->linkedin;
            $this->contactMeList['twitter']   = $databseValues->twitter;
            $this->contactMeList['instagram'] = $databseValues->instagram;
            $this->contactMeList['github']    = $databseValues->github;
            $this->contactMeList['telegram']  = $databseValues->telegram;
        }

        return view('contactMe_edit', ["values" => $this->contactMeList]);
    }


    public function store_contactMe(ContactMeRequest $request)
    {   
        /** 
         * Value of input lists should not be same
         */

        $validated = $request->validated();

        // store validated data as value in this->contactMeList array
        foreach($validated as $contactWay){
            $validatedKey = array_keys($validated, $contactWay)[0];             
            $this->contactMeList[$validatedKey] = $contactWay;
        }

        $contactObject = Auth::user()->contact();

        if ($contactObject->exists()){
            $contactMe = $contactObject->update([
                'email'     => $this->contactMeList['email'],
                'linkedin'  => $this->contactMeList['linkedin'],
                'twitter'   => $this->contactMeList['twitter'],
                'instagram' => $this->contactMeList['instagram'],
                'github'    => $this->contactMeList['github'],
                'telegram'  => $this->contactMeList['telegram']
            ]);

            if ($contactMe){
                Message::success("Data successfully updated.");
            }
            else{
                Message::failed("Cant update data");
            }
        }  
        else{
            $contactMe = $contactObject->create([
                'email'     => $this->contactMeList['email'],
                'linkedin'  => $this->contactMeList['linkedin'],
                'twitter'   => $this->contactMeList['twitter'],
                'instagram' => $this->contactMeList['instagram'],
                'github'    => $this->contactMeList['github'],
                'telegram'  => $this->contactMeList['telegram']
            ]);

            if ($contactMe){
                Message::success("Data successfully stored.");
            }
            else{
                Message::failed("Cant update data");
            }
        }
        
        return redirect()->route('show_contactMe_edit');
    }
}
