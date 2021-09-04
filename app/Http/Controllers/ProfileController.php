<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ChangeProfileRequest;
use App\Http\Requests\ProfilePicRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadFile\UploadManager;
use App\Http\Controllers\FlashMessage\Message;


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
        $profileName = $request->validated()["profileName"];

        User::where('id', $userId)->update([
            'name' => $profileName,
        ]);

        Message::success("Profile Name Successfully Changed.");

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
            UploadManager::profile_picture($profilePic, $userId);
            Message::success("Profile Picture Successfully Changed.");
        }
        return redirect()->route('change_profilePic');
    }
}
