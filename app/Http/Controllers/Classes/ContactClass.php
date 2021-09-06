<?php

namespace App\Http\Controllers\Classes;
use App\Http\Controllers\FlashMessage\Message;


class ContactClass {
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

        if ($updateContact){
            Message::success("Data successfully updated.");
        }
        else{
            Message::failed("Cant update data");
        }
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

        if ($createContact){
            Message::success("Data successfully stored.");
        }
        else{
            Message::failed("Cant update data");
        }
    }
}