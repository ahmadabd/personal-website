<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Http\Controllers\FileManager\UploadManager;
use App\Http\Controllers\FileManager\BookAddManager;
use App\Http\Controllers\Classes\SuccessOrFailMessage;


class BookController extends Controller
{
    public function show_books_to_client()
    {
        return view('books');
    }

    public function show_book_editPage()
    {
        // send a list of book id ro view

        return view('books_edit');
    }

    public function store_books(BookRequest $request)
    {
        $userId = auth()->user()->id;

        if ($request->file()){
            $book_picture = $request->file('book_picture');
            $fileId = BookAddManager::book_picture($book_picture, $userId);
        }

        $storedBook = Book::create([
            'user_id'       => $userId,
            'file_id'       => $fileId,
            'title'         => $request->title,
            'descriptions'  => $request->descriptions,
            'url'           => $request->url
        ]);

        SuccessOrFailMessage::SuccessORFail($storedBook, "Successfully added new book", "Failed to add new book.");

        return redirect()->route('book_editPage');
    }

    public function update_books(BookRequest $request, Book $id)
    {
        # code...
    }


    public function delete_books(Book $id)
    {
        # code...
    }
}
