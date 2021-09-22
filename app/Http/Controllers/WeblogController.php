<?php

namespace App\Http\Controllers;

use App\Exceptions\WeblogException;
use App\Http\Requests\WeblogRequest;
use App\Models\Weblog;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Classes\SuccessOrFailMessage;


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

        $weblog = Auth::user()->weblog();

        // Update weblog Model if there are stored value in DataBase else Create
        $storedWeblog = ($weblog->exists())
        ? $weblog->update($request->validated())
        : $weblog->create($request->validated());

        // if data has successfully stored in DB Send Success else send Failed Message
        SuccessOrFailMessage::SuccessORFail($storedWeblog, "Weblog stored Successsfully", "Failed to store new weblog address");

        return redirect()->route('weblog_edit');
    }
}
