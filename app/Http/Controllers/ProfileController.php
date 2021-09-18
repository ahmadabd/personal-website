<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ChangeProfileRequest;
use App\Http\Requests\ProfilePicRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FileManager\UpdateManager;
use App\Http\Controllers\Classes\SuccessOrFailMessage;


class ProfileController extends Controller
{
    public function show_profileName_editPage()
    {
        /**
         * Show profileName edit page to admin
         */
        $username = Auth::user()->name;

        return view('profileName', ['profileName' => $username]);
    }


    public function store_new_profileName(ChangeProfileRequest $request)
    {
        /**
         * store new profile name in User.name field
         */

        $userId = auth()->user()->id;

        $storedProfileName = User::where('id', $userId)->update($request->validated());

        // if data has successfully stored in DB Send Success else send Failed Message
        SuccessOrFailMessage::SuccessORFail($storedProfileName);

        return redirect()->route('change_profileName');
    }


    public function show_profilePic_editPage()
    {
        /**
         * show profile picture edit page to admin
         */
        return view('profilePic');
    }


    public function store_new_profilePic(ProfilePicRequest $request)
    {
        /**
         * store profile picture in database
         */
        $userId = auth()->user()->id;

        if ($request->file()){
            $profilePic = $request->file('profilePic');
            $storedProfilePicture = UpdateManager::profile_picture($profilePic, $userId);

            SuccessOrFailMessage::SuccessORFail($storedProfilePicture);
        }
        return redirect()->route('change_profilePic');
    }
}
