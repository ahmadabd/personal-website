<?php

namespace App\Http\Controllers;

use App\Exceptions\WeblogException;
use App\Http\Requests\WeblogRequest;
use App\Models\Weblog;
use App\Http\Controllers\FlashMessage\Message;
use Illuminate\Support\Facades\Auth;

class WeblogController extends Controller
{
    public function show_weblog_to_client()
    {

        $weblogAddress = "";

        if (Weblog::exists()){
            $weblogAddress = Weblog::get()[0]->weblog_address;
        }

        try{
            return redirect()->away($weblogAddress);
        } catch(\Exception $exception){
            throw new WeblogException();
        }
    }


    public function show_weblog_editPage()
    {
        $lastWeblogUrl = "";
        
        $weblogObject = Auth::user()->weblog();

        if ($weblogObject->exists()){
            $lastWeblogUrl = $weblogObject->get()[0]->weblog_address;
        }
        return view('weblog_edit', ['lastWeblogUrl' => $lastWeblogUrl]);
    }


    public function store_weblog_url(WeblogRequest $request)
    {
        $weblog_url = $request->validated()['weblogUrl'];
        $weblogObject = Auth::user()->weblog();

        if ($weblogObject->exists()){
            $weblogObject->update([
                'weblog_address' => $weblog_url
            ]);
        }    
        else{
            $weblogObject->create([
                'weblog_address' => $weblog_url
            ]);
        }
    
        Message::success('Weblog address successfully stored in DataBase.');

        return redirect()->route('weblog_edit');
    }
}
