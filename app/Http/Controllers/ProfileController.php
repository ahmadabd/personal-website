<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Classes\ProfilePicStoreClass;
use App\Models\User;
use App\Http\Requests\ChangeProfileRequest;
use App\Http\Requests\ProfilePicRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FileManager\UpdateManager;
use App\Http\Controllers\FlashMessage\SuccessOrFailMessage;


class ProfileController extends Controller
{
    public function show_profileName_editPage()
    {
        $username = Auth::user()->name;

        return view('profileName', ['profileName' => $username]);
    }


    public function store_new_profileName(ChangeProfileRequest $request)
    {
        $userId = auth()->user()->id;

        $storedProfileName = User::where('id', $userId)->update($request->validated());
        SuccessOrFailMessage::SuccessORFail($storedProfileName);

        return redirect()->route('change_profileName');
    }


    public function show_profilePic_editPage()
    {
        return view('profilePic');
    }


    public function store_new_profilePic(ProfilePicRequest $request)
    {
        $userId = auth()->user()->id;

        if ($request->file()){
            $profilePic = $request->file('profilePic');
            $fileData = UpdateManager::profile_picture($profilePic, $userId);

            $storedProfilePicture = ProfilePicStoreClass::create($fileData, $userId);
            SuccessOrFailMessage::SuccessORFail($storedProfilePicture);
        }
        return redirect()->route('change_profilePic');
    }
}
