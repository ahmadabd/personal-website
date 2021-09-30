<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeblogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_show_weblog_to_client_failed_message_when_db_isEmpty()
    {
        $this->withExceptionHandling();

        $response = $this->get('/weblog');

        $response->assertOk();
        $response->assertSee('Weblog Not Found!(404)');
    }
}
