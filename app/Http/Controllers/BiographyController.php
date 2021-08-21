<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\FlashMessage\Message;
use App\Http\Requests\BiographyRequest;
use App\Models\Bio;


class BiographyController extends Controller
{

    public function show(Request $request)
    {
        $bio = "";

        // If there is no Biography stored in DataBase, Call failed FlashMessage
        if (Bio::count() == 0){
            $message = Message::failed("There is no Biography information.");
            $request->$message;            
        }
        else{
            // get biography from table
            $bio = Bio::get('biography')[0]['biography'];
        }

        return view('aboutMe', ['bio' => $bio]);
    }


    public function storeForm()
    {
        $value = "";

        // If there is Biography in DataBase, puts it as default value in dashboard view
        if (Bio::count() >= 1){
            $value = Bio::get('biography')[0]['biography'];
        }

        return view('dashboard', ["value" => $value]);
    }


    public function store(BiographyRequest $request)
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
        
        return redirect()->Route('dashboard');
    }
}
