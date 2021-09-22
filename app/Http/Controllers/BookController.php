<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Http\Controllers\FileManager\UpdateManager;
use App\Http\Controllers\FileManager\DeleteManager;
use App\Http\Controllers\FileManager\AddManager;
use App\Http\Controllers\FlashMessage\SuccessOrFailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Classes\BookStoreClass;


class BookController extends Controller
{
    public function show_books_to_client()
    {
        /**
         * Show users Books to Clients
         */

        return view('books');
    }


    public function show_book_editPage()
    {
        /**
         * Show stored books for update, add and delete to admin
         */

        $books = Auth::user()->book()->get();

        return view('books_edit', ["books" => $books]);
    }


    public function store_books(BookRequest $request)
    {
        /**
         * Stores new book
         */

        $userId = auth()->user()->id;
        $validatedData = $request->validated();

        if ($request->file()){
            $book_picture = $request->file('book_picture');
            $fileData = AddManager::book_picture($book_picture);
        }

        $storedBook = BookStoreClass::create($fileData, $userId, $validatedData);
        SuccessOrFailMessage::SuccessOrFail($storedBook, "Successfully added new book", "Failed to add new book");

        return redirect()->route('book_editPage');
    }


    public function update_books(BookRequest $request, Book $book)
    {
        /**
         * Update Old book completely (picture, url, title, descriptions)
         * or just update (url, title, descriptions)
         */

        if (! Gate::allows("update", $book)){
            abort(403);
        }

        $userId = auth()->user()->id;
        $validatedData = $request->validated();

        if ($request->file()){
            $book_picture = $request->file('book_picture');
            $fileData = UpdateManager::book_picture($book_picture, $book->id);
            $updatedBook = BookStoreClass::create($fileData, $userId, $validatedData, $book->id);
        }
        else{
            $updatedBook = BookStoreClass::update($validatedData, $book->id);
        }

        SuccessOrFailMessage::SuccessORFail($updatedBook, "Successfully Updated new book", "Failed to update new book.");

        return redirect()->route('book_editPage');
    }


    public function delete_books(Book $book)
    {
        /**
         * Delete selected Book to delete
         */

        if (! Gate::allows("delete", $book)){
            abort(403);
        }

        $deletedBook = DeleteManager::book_picture($book->id);
        SuccessOrFailMessage::SuccessORFail($deletedBook);

        return redirect()->route('book_editPage');
    }
}
