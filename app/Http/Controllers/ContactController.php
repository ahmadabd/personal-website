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

    public function show_contactMe_to_client()
    {
        $icons = [
            'linkedin'  => 'entypo-linkedin-with-circle',
            'email'     => 'gmdi-email',
            'telegram'  => 'forkawesome-telegram',
            'instagram' => 'fab-instagram-square',
            'twitter'   => 'antdesign-twitter-circle',
            'github'    => 'bytesize-github'
        ];

        $availableContactLinks = [];

        // Get data from database
        $numberOfContactDBrows = Contact::count();

        if ($numberOfContactDBrows > 0){
            $databseValues = Contact::get()[0];

            foreach ($icons as $icon){
                $contactName = array_keys($icons, $icon)[0];
                if ($databseValues[$contactName]){
                    $availableContactLinks[$contactName] = [$icon, $databseValues[$contactName]];
                }
            }
        }
        if (count($availableContactLinks) == 0) {
            Message::failed("There is no Contact information.");
        }

        return view('contactMe', ['availableContactLinks' => $availableContactLinks]);   
    }


    public function show_contactMe_edit()
    {
        // Get data from database to show as value in input tag if exist
        $contactsObject = Auth::user()->contact();
        $numberOfContactDBrows = $contactsObject->count();
        if ($numberOfContactDBrows > 0){
            $databseValues = $contactsObject->get()[0];

            $this->contactMeList['email'] = $databseValues['email'];
            $this->contactMeList['linkedin'] = $databseValues['linkedin'];
            $this->contactMeList['twitter'] = $databseValues['twitter'];
            $this->contactMeList['instagram'] = $databseValues['instagram'];
            $this->contactMeList['github'] = $databseValues['github'];
            $this->contactMeList['telegram'] = $databseValues['telegram'];
        }

        return view('contactMe_edit', ["values" => $this->contactMeList]);
    }


    public function store_contactMe(ContactMeRequest $request)
    {   
        /** 
         * Value of input lists should not be same
         */

        $userId = auth()->user()->id;
        $validated = $request->validated();

        // store validated data as value in this->contactMeList array
        foreach($validated as $contactWay){
            $validatedKey = array_keys($validated, $contactWay)[0];             
            $this->contactMeList[$validatedKey] = $contactWay;
        }

        // delete old data from Contact model if exist
        $contactObject = Contact::where('user_id', $userId);
        if ($contactObject->count() > 0){
            $contactObject->delete();
        }  

        $contactMe = Contact::create([
            'user_id'   => $userId,
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
        
        return redirect()->route('show_contactMe_edit');
    }
}
