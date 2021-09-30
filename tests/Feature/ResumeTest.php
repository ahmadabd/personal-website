<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResumeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function check_show_resume_to_client_failed_message_when_db_isEmpty()
    {
        $this->withExceptionHandling();

        $response = $this->get('/resume');

        $response->assertOk();
        $response->assertSee('Resume Not Found!(404)');
    }
}
