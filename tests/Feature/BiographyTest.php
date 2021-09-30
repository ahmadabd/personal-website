<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BiographyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_show_biography_to_client_failed_message_when_db_isEmpty()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSessionHas('failed');
    }


}
