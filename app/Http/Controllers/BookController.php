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
        $books = Book::with('file')->get();

        if ($books){
            return view('books', ['books' => $books]);
        }
        else{
            SuccessOrFailMessage::Failed("There is no book stored.");
            return view('books');
        }
    }


    public function show_book_editPage()
    {
        $books = Auth::user()->book()->get();

        return view('books_edit', ["books" => $books]);
    }


    public function store_books(BookRequest $request)
    {
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
        if (! Gate::allows("update", $book)){
            abort(403);
        }

        $userId = auth()->user()->id;
        $validatedData = $request->validated();

        if ($request->file()){
            /**
             * if book_picture should update:
             * Remove old book picture and old book data from File and Book Model
             * Then store new data by create method in File and Book model
             */

            $book_picture = $request->file('book_picture');
            $fileData = UpdateManager::book_picture($book_picture, $book->id);
            $updatedBook = BookStoreClass::create($fileData, $userId, $validatedData, $book->id);
        }
        else{
            /**
             * if just title or url or description should update:
             * just update them to Book Model
             */
            $updatedBook = BookStoreClass::update($validatedData, $book->id);
        }

        SuccessOrFailMessage::SuccessORFail($updatedBook, "Successfully Updated new book", "Failed to update new book.");

        return redirect()->route('book_editPage');
    }


    public function delete_books(Book $book)
    {
        if (! Gate::allows("delete", $book)){
            abort(403);
        }

        $deletedBook = DeleteManager::book_picture($book->id);
        SuccessOrFailMessage::SuccessORFail($deletedBook);

        return redirect()->route('book_editPage');
    }
}
