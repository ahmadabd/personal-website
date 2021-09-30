<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_show_books_to_client_failed_message_when_db_isEmpty()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/book');

        $response->assertOk();
        $response->assertSessionHas('failed');
    }
}
