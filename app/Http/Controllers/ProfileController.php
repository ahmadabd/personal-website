<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ChangeProfileRequest;
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
}
