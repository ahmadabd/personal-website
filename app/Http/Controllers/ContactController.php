<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\ContactMeRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactController extends Controller
{
    public function show_contactMe_to_client(Request $request)
    {
        // Get it from Database
        // $contact = "phone: 123465";
        $contactMe = "";

        if ($contactMe == ""){
            
            $message = Message::failed("There is no Contact information.");
            
            $request->$message;
        }

        return view('contactMe', ['contact' => $contactMe]);   
    }

    public function show_contactMe_edit()
    {
        $userId = auth()->user()->id;
        $laststoredContact = [
            'email' => null, 
            'linkedin' => null, 
            'twitter' => null, 
            'instagram' => null, 
            'github' => null, 
            'telegram' => null
        ];

        if (Contact::where('user_id', $userId)->count() > 0){
            $databseValues = Auth::user()->contact()->get()[0];
    
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
        foreach($validated as $contactWay){
            $validatedKey = array_keys($validated, $contactWay)[0];             
            $contactMeList[$validatedKey] = $contactWay;
        }

        if (Contact::where('user_id', $userId)->count() > 0){
            Contact::where('user_id', $userId)->delete();
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
