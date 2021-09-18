<?php

namespace App\Http\Controllers\FileManager;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\File;


class BookPicture implements FileImp {

    private $FileStorePath = 'books';
    private $fileType = "book_picture";


    public function remove_old_file($bookId){
        // delete old resume
        $file = File::find($bookId);

        if($file->exists()){

            $oldProfilePath = $file->file_path;

            // Delete old profile picture from Database
            $file->delete();

            if (Storage::disk('public')->exists($oldProfilePath)){
                // Delete old profile picture from storage/public/profile
                Storage::disk('public')->delete($oldProfilePath);
            }

            return true;
        }

        return false;
    }


    public function add_new_file($file, $userId){

        $spliteFile = explode(".", $file->getClientOriginalName());
        $fileFormat = end($spliteFile);

        $randomFileName = Str::random(10);
        $fileName = $randomFileName.'.'.$fileFormat;

        // Picture stores in /storage/public/book
        $filePath = $file->storeAs($this->FileStorePath, $fileName, 'public');

        $storedResume = File::create([
            'user_id'   => $userId,
            'name'      => $fileName,
            'file_path' => $filePath,
            'file_type' => $this->fileType
        ]);

        return $storedResume->id;
    }
}
