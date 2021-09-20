<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Http\Controllers\FileManager\UpdateManager;
use App\Http\Controllers\FileManager\DeleteManager;
use App\Http\Controllers\FileManager\AddManager;
use App\Http\Controllers\Classes\SuccessOrFailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function show_books_to_client()
    {
        return view('books');
    }

    public function show_book_editPage()
    {
        $books = Auth::user()->book()->get();

        return view('books_edit', ["books" => $books]);
    }

    public function store_books(BookRequest $request)
    {
        $userId = auth()->user()->id;

        if ($request->file()){
            $book_picture = $request->file('book_picture');
            $fileId = AddManager::book_picture($book_picture, $userId);
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
