<?php

namespace App\Http\Controllers\Classes;

class ContactMeStoreClass {
    public static function Update($contact, $contactMeList)
    {
        $updatedContact = $contact->update([
            'email'     => $contactMeList['email'],
            'linkedin'  => $contactMeList['linkedin'],
            'twitter'   => $contactMeList['twitter'],
            'instagram' => $contactMeList['instagram'],
            'github'    => $contactMeList['github'],
            'telegram'  => $contactMeList['telegram']
        ]);

       return $updatedContact;
    }

    public static function Create($contact, $contactMeList)
    {
        $createdContact = $contact->create([
            'email'     => $contactMeList['email'],
            'linkedin'  => $contactMeList['linkedin'],
            'twitter'   => $contactMeList['twitter'],
            'instagram' => $contactMeList['instagram'],
            'github'    => $contactMeList['github'],
            'telegram'  => $contactMeList['telegram']
        ]);

       return $createdContact->exists();
    }
}
