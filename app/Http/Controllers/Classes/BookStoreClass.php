<?php

namespace App\Http\Controllers\Classes;

use App\Models\Book;
use App\Models\File;
use Illuminate\Support\Facades\DB;


class BookStoreClass {
    public static function create($fileData, $userId, $validatedData)
    {
        try {
            $storedBook = DB::transaction(function () use ($fileData, $userId, $validatedData) {
                $storedResume = File::create([
                    'user_id'   => $userId,
                    'name'      => $fileData['fileName'],
                    'file_path' => $fileData['filePath'],
                    'file_type' => $fileData["fileType"]
                ]);

                $storedBook = Book::create([
                    'user_id'       => $userId,
                    'file_id'       => $storedResume->id,
                    'title'         => $validatedData['title'],
                    'descriptions'  => $validatedData['descriptions'],
                    'url'           => $validatedData['url']
                ]);

                return $storedBook->exists();
            });
        }
        catch (\Exception $ex){
            throw $ex;
        }

        return $storedBook;
    }

    public static function update($validatedData, $bookId)
    {
        $updatedBook = Book::find($bookId)->update([
            'title'         => $validatedData['title'],
            'descriptions'  => $validatedData['descriptions'],
            'url'           => $validatedData['url']
        ]);

        return $updatedBook;
    }
}
