<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FlashMessage\SuccessOrFailMessage;
use App\Http\Requests\ContactMeRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Classes\ContactMeStoreClass;


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

        $contactMeLinks = [];

        if (Contact::exists()){

            $contact = Contact::get()[0];

            foreach ($this->icons as $iconName => $iconModule){
                if ($contact->$iconName){
                    $contactMeLinks[$iconName] = [$iconModule, $contact->$iconName];
                }
            }
        }
        if (empty($contactMeLinks)) {
            SuccessOrFailMessage::Failed("There are no way to Contact Me yet.");
        }

        return view('contactMe', ['contactLinks' => $contactMeLinks]);
    }


    public function show_contactMe_edit()
    {
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
        $validated = $request->validated();
        $contact = Auth::user()->contact();

        // Fill $contactMeList values by validated Data
        foreach($validated as $contactWay => $contactUrl){
            $this->contactMeList[$contactWay] = $contactUrl;
        }

        $storedContact = ($contact->exists())
            ? ContactMeStoreClass::update($contact, $this->contactMeList)
            : ContactMeStoreClass::create($contact, $this->contactMeList);

        SuccessOrFailMessage::SuccessORFail($storedContact);

        return redirect()->route('show_contactMe_edit');
    }
}
