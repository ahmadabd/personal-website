<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ChangeProfileRequest;
use App\Http\Requests\ProfilePicRequest;
use Illuminate\Support\Facades\Auth;


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
        return $request->file('profilePic');
    }
}
