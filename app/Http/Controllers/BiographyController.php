<?php

namespace App\Http\Controllers;
use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\BiographyRequest;
use App\Models\Bio;

use Illuminate\Support\Facades\Auth;


class BiographyController extends Controller
{

    public function show_biography_to_client()
    {
        $biographyData = "";

        // If there is no Biography stored in DataBase, Call failed FlashMessage
        if (Bio::count() == 0){
            Message::failed("There is no Biography information.");       
        }
        else{
            // get biography from table
            $biographyData = Bio::get()[0]['biography'];
        }

        return view('aboutMe', ['bio' => $biographyData]);
    }


    public function show_biography_editPage()
    {
        $lastStoredBiography = "";

        // If there is stored Biography in DataBase, puts it as default value in dashboard textarea
        $BioObject = Auth::user()->bio();
        $numberOfBioDBrows = $BioObject->count();
        if ($numberOfBioDBrows >= 1){
            $lastStoredBiography = $BioObject->get()[0]['biography'];
        }

        return view('dashboard', ["lastStoredBiography" => $lastStoredBiography]);
    }


    public function store_biography(BiographyRequest $request)
    {
        $userId = auth()->user()->id;

        $biography = $request->validated()["biography"];

        // If there is Biography in DataBase, update old biogaphy by new one
        $numberOfBioDBrows = Bio::where('user_id', $userId)->count();
        if ($numberOfBioDBrows >= 1){
            $wallet = Bio::where('user_id', $userId)->update([
                'user_id'  => $userId,
                'biography' => $biography,
            ]);
        }
        else{
            // If there is no Biography stored in DataBase, Create new one
            $wallet = Bio::create([
                'user_id'  => $userId,
                'biography' => $biography,
            ]);    
        }

        Message::success("Biography Successfully Changed.");
        
        return redirect()->route('edit_biography');
    }
}
