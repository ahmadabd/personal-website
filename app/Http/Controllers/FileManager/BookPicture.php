<?php

namespace App\Http\Controllers\FileManager;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookPicture implements FileImp {

    private $FileStorePath = 'books';
    private $fileType = "book_picture";


    public function remove_old_file($bookId){
        // delete old resume
        $book = Book::find($bookId);

        if($book->exists()){

            $profilePic = File::find($book->file_id);
            $oldProfilePath = $profilePic->file_path;

            // Delete old profile picture from Database
            try {
                DB::transaction(function () use ($book, $profilePic) {
                    $book->delete();
                    $profilePic->delete();
                });
            }
            catch (\Exception $ex){
                throw $ex;
            }


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

        return [
            "filePath" => $filePath,
            "fileName" => $fileName,
            "fileType" => $this->fileType
        ];
    }
}
