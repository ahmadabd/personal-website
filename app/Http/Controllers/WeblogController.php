<?php

namespace App\Http\Controllers;

use App\Exceptions\WeblogException;
use App\Http\Requests\WeblogRequest;
use Illuminate\Http\Request;
use App\Models\Weblog;
use App\Http\Controllers\FlashMessage\Message;


class WeblogController extends Controller
{
    public function show_weblog_to_client()
    {

        $weblogAddress = "";

        if (Weblog::count() > 0){
            $weblogAddress = Weblog::get('weblog_address')[0]['weblog_address'];
        }

        try{
            return redirect()->away($weblogAddress);
        } catch(\Exception $exception){
            throw new WeblogException();
        }
    }

    public function show_weblog_editPage()
    {
        return view('weblog_edit');
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
