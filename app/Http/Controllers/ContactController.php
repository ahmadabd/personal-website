<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\ContactMeRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class ContactController extends Controller
{
    public function show_contactMe_to_client()
    {
        $icons = [
            'linkedin' => 'entypo-linkedin-with-circle',
            'email' => 'gmdi-email',
            'telegram' => 'forkawesome-telegram',
            'instagram' => 'fab-instagram-square',
            'twitter' => 'antdesign-twitter-circle',
            'github' => 'bytesize-github'
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
        $laststoredContact = [
            'email' => null, 
            'linkedin' => null, 
            'twitter' => null, 
            'instagram' => null, 
            'github' => null, 
            'telegram' => null
        ];

        // Get data from database to show as value in input tag if exist
        $contactsObject = Auth::user()->contact();
        $numberOfContactDBrows = $contactsObject->count();
        if ($numberOfContactDBrows > 0){
            $databseValues = $contactsObject->get()[0];
    
            $laststoredContact['email'] = $databseValues['email'];
            $laststoredContact['linkedin'] = $databseValues['linkedin'];
            $laststoredContact['twitter'] = $databseValues['twitter'];
            $laststoredContact['instagram'] = $databseValues['instagram'];
            $laststoredContact['github'] = $databseValues['github'];
            $laststoredContact['telegram'] = $databseValues['telegram'];
        }

        return view('contactMe_edit', ["values" => $laststoredContact]);
    }

    public function store_contactMe(ContactMeRequest $request)
    {   
        $userId = auth()->user()->id;
        $validated = $request->validated();

        $contactMeList = [
            'email' => null, 
            'linkedin' => null, 
            'twitter' => null, 
            'instagram' => null, 
            'github' => null, 
            'telegram' => null
        ];

        // Value of input lists should not be same

        // store validated data as value in contactMeList array
        foreach($validated as $contactWay){
            $validatedKey = array_keys($validated, $contactWay)[0];             
            $contactMeList[$validatedKey] = $contactWay;
        }

        // delete old data from Contact model if exist
        $contactObject = Contact::where('user_id', $userId);
        if ($contactObject->count() > 0){
            $contactObject->delete();
        }  

        $contactMe = Contact::create([
            'user_id' => $userId,
            'email' => $contactMeList['email'],
            'linkedin' => $contactMeList['linkedin'],
            'twitter' => $contactMeList['twitter'],
            'instagram' => $contactMeList['instagram'],
            'github' => $contactMeList['github'],
            'telegram' => $contactMeList['telegram']
        ]);

        if ($contactMe){
            Message::success("Data successfully stored.");
        }
        
        return redirect()->route('show_contactMe_edit');
    }
}
