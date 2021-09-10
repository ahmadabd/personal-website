<?php

namespace App\Http\Controllers\Classes;

class ContactMeStoreClass {
    public static function Update($contact, $contactMeList)
    {
        $updateContact = $contact->update([
            'email'     => $contactMeList['email'],
            'linkedin'  => $contactMeList['linkedin'],
            'twitter'   => $contactMeList['twitter'],
            'instagram' => $contactMeList['instagram'],
            'github'    => $contactMeList['github'],
            'telegram'  => $contactMeList['telegram']
        ]);

       return $updateContact;
    }

    public static function Create($contact, $contactMeList)
    {
        $createContact = $contact->create([
            'email'     => $contactMeList['email'],
            'linkedin'  => $contactMeList['linkedin'],
            'twitter'   => $contactMeList['twitter'],
            'instagram' => $contactMeList['instagram'],
            'github'    => $contactMeList['github'],
            'telegram'  => $contactMeList['telegram']
        ]);

       return $createContact;
    }
}