<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\BiographyRequest;
use App\Models\Bio;


class BiographyController extends Controller
{

    public function show_biography_to_client(Request $request)
    {
        $biographyData = "";

        // If there is no Biography stored in DataBase, Call failed FlashMessage
        if (Bio::count() == 0){
            $failedToGetBiographyMessage = Message::failed("There is no Biography information.");
            $request->$failedToGetBiographyMessage;            
        }
        else{
            // get biography from table
            $biographyData = Bio::get('biography')[0]['biography'];
        }

        return view('aboutMe', ['bio' => $biographyData]);
    }


    public function show_biography_editPage_to_admin()
    {
        $lastStoredBiography = "";

        // If there is stored Biography in DataBase, puts it as default value in dashboard textarea
        if (Bio::count() >= 1){
            $lastStoredBiography = Bio::get('biography')[0]['biography'];
        }

        return view('dashboard', ["lastStoredBiography" => $lastStoredBiography]);
    }


    public function store_biography_to_database(BiographyRequest $request)
    {
        $userId = auth()->user()->id;

        // If there is Biography in DataBase, update old biogaphy by new one
        if (Bio::count() >= 1){
            $wallet = Bio::where('user_id', $userId)->update([
                'user_id'  => $userId,
                'biography' => $request->biography,
            ]);
        }
        else{
            // If there is no Biography stored in DataBase, Create new one
            $wallet = Bio::create([
                'user_id'  => $userId,
                'biography' => $request->biography,
            ]);    
        }
        
        return redirect()->route('edit_biography');
    }
}
