<?php

namespace Tests\MyPackages;

use App\Models\Book;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


trait AddBook
{
    public function store_new_book_with_its_profile_picture()
    {
        // Store new book
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->post(route('store_book'), [
            'title'         => 'test title',
            'descriptions'  => 'test description',
            'url'           => 'http://google.com',
            'book_picture'  => $file
        ]);
        $response->assertSessionHas('success');
        $this->assertEquals(1, Book::count());

        $fileName = Book::first()->cover;
        Storage::disk('public')->assertExists("{$fileName}");

        return $response;
    }
}
