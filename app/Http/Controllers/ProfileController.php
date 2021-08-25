<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ChangeProfileRequest;
use App\Http\Requests\ProfilePicRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadFile\ProfilePicture;


class ProfileController extends Controller
{
    public function show_profileName_editPage()
    {
        $profileName = Auth::user()->name;

        return view('profileName', ['profileName' => $profileName]);
    }

    public function store_new_profileName(ChangeProfileRequest $request)
    {
        $userId = auth()->user()->id;

        $profile = User::where('id', $userId)->update([
            'name' => $request->profileName,
        ]);

        return redirect()->route('change_profileName');
    }

    public function show_profilePic_editPage()
    {
        return view('profilePic');
    }

    public function store_new_profilePic(ProfilePicRequest $request)
    {
        if ($request->file()){
            $profilePic = new ProfilePicture();
            $profilePic->remove_old_file("img");
            $profilePic->add_new_file($request->file('profilePic'), "img");
        }
        return redirect()->route('change_profilePic');
    }
}
