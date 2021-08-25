<?php

namespace App\Http\Controllers\UploadFile;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProfilePicture implements Uploader {

    private $profilePicturePath = 'profile';

    public function remove_old_file($fileType){

        // delete old profile picture
        if(File::where('file_type', $fileType)->count() > 0){
            
            $oldProfilePath = File::where('file_type', $fileType)->get()[0]['file_path'];
            
            // Delete old profile picture from Database
            File::where('file_path', $oldProfilePath)->delete();
            
            if (Storage::disk('public')->exists($oldProfilePath)){
                    
                // Delete old profile picture from storage/public/profile
                Storage::disk('public')->delete($oldProfilePath);   
            }
        }
    }

    public function add_new_file($file, $fileType){

        $spliteFile = explode(".", $file->getClientOriginalName());
        $fileFormat = end($spliteFile);
        
        $fileName = Str::random(10).'.'.$fileFormat;

        // Picture stores in /storage/public/profile
        $filePath = $file->storeAs($this->profilePicturePath, $fileName, 'public');
        
        File::create([
            'name' => $fileName,
            'file_path' => $filePath,
            'file_type' => $fileType
        ]);
    }
}