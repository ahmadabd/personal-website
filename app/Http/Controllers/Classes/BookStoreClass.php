<?php

namespace App\Http\Controllers\Classes;

use App\Models\Book;

class BookStoreClass {
    public static function create($fileData, $userId, $validatedData)
    {
        $storedBook = Book::create([
            'user_id'       => $userId,
            'title'         => $validatedData['title'],
            'descriptions'  => $validatedData['descriptions'],
            'url'           => $validatedData['url'],
            'cover'         => $fileData['filePath'],
        ]);

        return $storedBook->exists();
    }

    public static function update($validatedData, $bookId, $fileData)
    {
        if (empty($fileData)){
            $updatedBook = Book::find($bookId)->update([
                'title'         => $validatedData['title'],
                'descriptions'  => $validatedData['descriptions'],
                'url'           => $validatedData['url'],
            ]);
        }
        else {
            $updatedBook = Book::find($bookId)->update([
                'title'         => $validatedData['title'],
                'descriptions'  => $validatedData['descriptions'],
                'url'           => $validatedData['url'],
                'cover'         => $fileData['filePath'],
            ]);
        }

        return $updatedBook;
    }
}
