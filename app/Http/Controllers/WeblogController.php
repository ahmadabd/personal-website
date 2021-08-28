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

        if (Weblog::count() > 0){
            $weblogAddress = Weblog::get()[0]['weblog_address'];
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
        $numberOfWeblogDBRows = $weblogObject->count();
        if ($numberOfWeblogDBRows > 0){
            $lastWeblogUrl = $weblogObject->get()[0]['weblog_address'];
        }
        return view('weblog_edit', ['lastWeblogUrl' => $lastWeblogUrl]);
    }

    public function store_weblog_url(WeblogRequest $request)
    {
        $weblog_url = $request->validated()['weblogUrl'];
        $userId = auth()->user()->id;

        if ($weblog_url){
            if (Weblog::count() > 0){
                Weblog::where('user_id', $userId)->delete();
            }    
            Weblog::create([
                'user_id' => $userId,
                'weblog_address' => $weblog_url
            ]);
        
            Message::success('Weblog address successfully stored in DataBase.');
        }

        return redirect()->route('weblog_edit');
    }
}
