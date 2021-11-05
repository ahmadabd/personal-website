<?php

namespace App\Http\Controllers\FileManager;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use Exception;

class BookPicture implements FileImp {
    private $FileStorePath = 'books';

    public function remove_old_file($bookId){

        $cover = Book::find($bookId)->cover;

        try {
            Book::find($bookId)->update([
                'cover' => null,
            ]);

            if (Storage::disk('public')->exists($cover)){
                Storage::disk('public')->delete($cover);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function add_new_file($file){

        $spliteFile = explode(".", $file->getClientOriginalName());
        $fileFormat = end($spliteFile);

        $randomFileName = Str::random(10);
        $fileName = $randomFileName.'.'.$fileFormat;

        // Picture stores in storage/app/public/books
        $filePath = $file->storeAs($this->FileStorePath, $fileName, 'public');

        return [
            "filePath" => $filePath
        ];
    }
}
