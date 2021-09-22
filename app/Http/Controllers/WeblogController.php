<?php

namespace App\Http\Controllers;

use App\Exceptions\WeblogException;
use App\Http\Requests\WeblogRequest;
use App\Models\Weblog;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FlashMessage\SuccessOrFailMessage;


class WeblogController extends Controller
{
    public function show_weblog_to_client()
    {
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
        $lastWeblogUrl = "";

        $weblog = Auth::user()->weblog();

        if ($weblog->exists()){
            $lastWeblogUrl = $weblog->get()[0]->weblog_address;
        }
        return view('weblog_edit', ['lastWeblogUrl' => $lastWeblogUrl]);
    }


    public function store_weblog_url(WeblogRequest $request)
    {
        $weblog = Auth::user()->weblog();

        $storedWeblog = ($weblog->exists())
        ? $weblog->update($request->validated())
        : $weblog->create($request->validated());

        SuccessOrFailMessage::SuccessORFail($storedWeblog, "Weblog stored Successsfully", "Failed to store new weblog address");

        return redirect()->route('weblog_edit');
    }
}
