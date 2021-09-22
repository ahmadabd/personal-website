<?php

namespace App\Http\Controllers\FileManager;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProfilePicture implements FileImp {

    private $FileStorePath = 'profile';
    private $fileType = "img";

    public function remove_old_file($userId){

        // delete old profile picture
        $file = File::where('user_id', $userId)->where('file_type', $this->fileType);

        if($file->exists()){

            $oldProfilePath = $file->get()[0]->file_path;

            // Delete old profile picture from Database
            File::where('file_path', $oldProfilePath)->delete();

            if (Storage::disk('public')->exists($oldProfilePath)){
                // Delete old profile picture from storage/public/profile
                Storage::disk('public')->delete($oldProfilePath);
            }

            return true;
        }

        return false;
    }


    public function add_new_file($file){

        $spliteFile = explode(".", $file->getClientOriginalName());
        $fileFormat = end($spliteFile);

        $randomFileName = Str::random(10);
        $fileName = $randomFileName.'.'.$fileFormat;

        // Picture stores in /storage/public/profile
        $filePath = $file->storeAs($this->FileStorePath, $fileName, 'public');

        return [
            "filePath" => $filePath,
            "fileName" => $fileName,
            "fileType" => $this->fileType
        ];
    }
}
