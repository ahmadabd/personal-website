<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\ChangeProfileRequest;
use App\Http\Requests\ProfilePicRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

use Illuminate\Support\Facades\Storage;


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
            $fileFormat = explode(".", $request->file('profilePic')->getClientOriginalName());
            $fileFormat = end($fileFormat);
            
            $fileName = Str::random(10).'.'.$fileFormat;
            

            // We want this for CV too, make an interface for that
            // delete old profile picture
            if(File::where('file_type', 'img')->count() > 0){
            
                $oldProfilePath = File::where('file_type', 'img')->get()[0]['file_path'];
                
                // Delete old profile picture from Database
                File::where('file_path', $oldProfilePath)->delete();

                if (Storage::disk('public')->exists($oldProfilePath)){
                    
                    // Delete old profile picture from storage/public/profile
                    Storage::disk('public')->delete($oldProfilePath);   
                }
            }
            

            // Picture stores in /storage/public/profile
            $filePath = $request->file('profilePic')->storeAs('profile', $fileName, 'public');
            
            File::create([
                'name' => $fileName,
                'file_path' => $filePath,
                'file_type' => 'img'
            ]);
        }
        return redirect()->route('change_profilePic');
    }
}
