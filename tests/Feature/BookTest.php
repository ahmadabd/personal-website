<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;
use App\Models\Book;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class BookTest extends TestCase
{
    use RefreshDatabase;
    use AuthUser;

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

        // $file = File::factory()->create([
        //     'user_id' => $user->id
        // ]);

        // Book::factory()->create([
        //     'user_id' => $user->id,
        //     'file_id' => $file->id
        // ]);

        $user = $this->make_a_user_that_actAs_authenticated();

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
        $this->assertEquals(1, File::count());

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
        $user = $this->make_a_user_that_actAs_authenticated();

        $file = File::factory()->create([
            'user_id' => $user->id
        ]);

        Book::factory()->create([
            'user_id' => $user->id,
            'file_id' => $file->id
        ]);

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
        $this->assertEquals(1, File::count());

        $fileName = File::get()[0]->name;
        Storage::disk('public')->assertExists("books/{$fileName}");

        $this->assertNotNull(Storage::disk('public'));

        Storage::disk('public')->assertMissing('books/missing.jpg');
    }


    /** @test */
    // public function check_update_books()
    // {

    // }


    /** @test */
    public function check_delete_books()
    {
        $this->withExceptionHandling();
        $user = $this->make_a_user_that_actAs_authenticated();

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
        $this->assertEquals(1, File::count());

        $book = Book::get()[0];
        $fileName = File::get()[0]->name;

        $response = $this->delete(route('delete_book', [ $book->id ]));
        $response->assertSessionHas('success');
        $this->assertEquals(0, Book::count());
        $this->assertEquals(0, File::count());

        Storage::disk('public')->assertMissing("books/{$fileName}");
    }
}
