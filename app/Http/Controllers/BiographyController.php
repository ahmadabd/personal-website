<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FlashMessage\SuccessOrFailMessage;
use App\Http\Requests\BiographyRequest;
use App\Models\Bio;
use Illuminate\Support\Facades\Auth;


class BiographyController extends Controller
{

    public function show_biography_to_client()
    {
        if (!Bio::exists() || !Bio::get()[0]->biography){
            // If there is no Biography stored or biography field is null make a failed message
            SuccessOrFailMessage::Failed("There is no available Biography to show.");
        }

        $biography = Bio::get()[0]->biography ?? "";

        return view('aboutMe', ['bio' => $biography]);
    }


    public function show_biography_editPage()
    {
        $biography = "";
        $bio = Auth::user()->bio();

        $biography = $bio->get()[0]->biography ?? "";

        return view('dashboard', ["biography" => $biography]);
    }


    public function store_biography(BiographyRequest $request)
    {
        $bio = Auth::user()->bio();

        $storedBio = ($bio->exists())
        ? $bio->update($request->validated())
        : $bio->create($request->validated());

        SuccessOrFailMessage::SuccessORFail($storedBio);

        return redirect()->route('edit_biography');
    }
}
