<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show_books_to_client()
    {
        return view('books');
    }

    public function show_book_editPage()
    {
        

        return view('books_edit');
    }

    public function store_books(BookRequest $reqest)
    {
        dd($reqest->validated());
        return redirect()->route('book_editPage');
    }
}
