<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;
use App\Models\Book;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Tests\MyPackages\AddBook;
use Illuminate\Http\UploadedFile;


class BookTest extends TestCase
{
    use RefreshDatabase;
    use AuthUser;
    use AddBook;

    /** @test */
    public function check_show_books_to_client_failed_message_when_db_isEmpty()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(
            route('show_books')
        );

        $response->assertOk();
        $response->assertSessionHas('failed');
    }


    /** @test */
    public function check_show_books_to_client_failed_message_when_db_is_not_empty()
    {
        $this->withoutExceptionHandling();
        $user = $this->make_a_user_that_actAs_authenticated();

        $this->store_new_book_with_its_profile_picture();

        $response = $this->get(
            route('show_books')
        );

        $response->assertSee('test');

        // Check that Book->file_id == File->id
        $this->assertEquals(Book::get()[0]->file_id, File::get()[0]->id);
    }


    /** @test */
    public function check_show_book_editPage_when_db_is_not_empty()
    {
        $this->withoutExceptionHandling();
        $this->make_a_user_that_actAs_authenticated();

        $this->store_new_book_with_its_profile_picture();

        $response = $this->get(
            route('book_editPage')
        );

        $response->assertSee('test');
    }


    /** @test */
    public function check_show_book_editPage_when_db_is_empty()
    {
        $this->withoutExceptionHandling();
        $user = $this->make_a_user_that_actAs_authenticated();

        $response = $this->get(
            route('book_editPage')
        );

        $response->assertSee('Books');
    }


    /** @test */
    public function check_store_books()
    {
        $this->withExceptionHandling();
        $this->make_a_user_that_actAs_authenticated();

        $this->store_new_book_with_its_profile_picture();

        $fileName = File::get()[0]->name;
        Storage::disk('public')->assertExists("books/{$fileName}");

        $this->assertNotNull(Storage::disk('public'));

        Storage::disk('public')->assertMissing('books/missing.jpg');
    }


    /** @test */
    public function check_update_books_without_updating_file()
    {
        $this->withoutExceptionHandling();

        $this->make_a_user_that_actAs_authenticated();

        $this->store_new_book_with_its_profile_picture();


        $book = Book::get()[0];
        $response_without_updating_file = $this->put(route('update_book', [ $book->id ]), [
            'title' => 'updated title',
            'descriptions' => 'updated description',
            'url' => 'http://yahoo.com'
        ]);

        $response_without_updating_file->assertSessionHas('success');
        $this->assertEquals('updated title', Book::get()[0]->title);
    }


    /** @test */
    public function check_update_books_with_updating_file()
    {
        $this->withoutExceptionHandling();

        $this->make_a_user_that_actAs_authenticated();

        $this->store_new_book_with_its_profile_picture();

        $file = UploadedFile::fake()->image('newPicture.jpg');

        $book = Book::get()[0];
        $response_with_updating_file = $this->put(route('update_book', [ $book->id ]), [
            'title'         => 'updated title',
            'descriptions'  => 'updated description',
            'url'           => 'http://yahoo.com',
            'book_picture'  => $file
        ]);

        $response_with_updating_file->assertSessionHas('success');
        $this->assertEquals('updated title', Book::get()[0]->title);

        $fileName = File::get()[0]->name;
        Storage::disk('public')->assertExists("books/{$fileName}");
    }


    /** @test */
    public function check_delete_books()
    {
        $this->withExceptionHandling();

        $user = $this->make_a_user_that_actAs_authenticated();

        $this->store_new_book_with_its_profile_picture();

        $book = Book::get()[0];
        $fileName = File::get()[0]->name;

        $response = $this->delete(route('delete_book', [ $book->id ]));
        $response->assertSessionHas('success');
        $this->assertEquals(0, Book::count());
        $this->assertEquals(0, File::count());

        Storage::disk('public')->assertMissing("books/{$fileName}");
    }
}
