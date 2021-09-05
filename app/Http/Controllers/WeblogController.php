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
        /**
         * send client to weblog page
         */
        $weblogAddress = "";

        if (Weblog::exists() && Weblog::get()[0]->weblog_address){
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
        /**
         * show weblog edit page to admin
         */
        $lastWeblogUrl = "";
        
        $weblog = Auth::user()->weblog();

        if ($weblog->exists()){
            $lastWeblogUrl = $weblog->get()[0]->weblog_address;
        }
        return view('weblog_edit', ['lastWeblogUrl' => $lastWeblogUrl]);
    }


    public function store_weblog_url(WeblogRequest $request)
    {
        /**
         * store new weblog url to database
         */
        $weblogUrl = $request->validated()['weblogUrl'];
        $weblog = Auth::user()->weblog();

        if ($weblog->exists()){
            $weblog->update([
                'weblog_address' => $weblogUrl
            ]);
        }    
        else{
            $weblog->create([
                'weblog_address' => $weblogUrl
            ]);
        }
    
        Message::success('Weblog address successfully stored in DataBase.');

        return redirect()->route('weblog_edit');
    }
}
