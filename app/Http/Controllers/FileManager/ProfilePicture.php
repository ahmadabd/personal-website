<?php

namespace App\Http\Controllers\FileManager;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProfilePicture implements FileImp {

    private $FileStorePath = 'profile';

    public function remove_old_file($userId){

        $user = User::find($userId);

        if($user->profilePicture !== null){

            $oldProfilePath = $user->profilePicture;

            $user->where('profilePicture', $oldProfilePath)->update([
                "profilePicture" => "null"
            ]);

            if (Storage::disk('public')->exists($oldProfilePath)){
                Storage::disk('public')->delete($oldProfilePath);
            }
        }

        return true;
    }


    public function add_new_file($file){

        $spliteFile = explode(".", $file->getClientOriginalName());
        $fileFormat = end($spliteFile);

        $randomFileName = Str::random(10);
        $fileName = $randomFileName.'.'.$fileFormat;

        // Picture stores in /storage/public/profile
        $filePath = $file->storeAs($this->FileStorePath, $fileName, 'public');

        return [
            "filePath" => $filePath
        ];
    }
}
