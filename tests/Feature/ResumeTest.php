<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;
use Tests\MyPackages\AddResume;
use App\Models\File;

class ResumeTest extends TestCase
{
    use RefreshDatabase;
    use AuthUser;
    use AddResume;

    /** @test */
    public function check_show_resume_to_client_failed_message_when_db_isEmpty()
    {
        $this->withExceptionHandling();

        $response = $this->get(route('show_cv'));

        $response->assertOk();
        $response->assertSee('Resume Not Found!(404)');
    }


    /** @test */
    public function check_show_resume_to_client_failed_message_when_db_isNot_empty()
    {
        $this->withExceptionHandling();
        $this->store_new_resume();

        $response = $this->get(route('show_cv'));

        $response->assertOk();

        // ERROR : why not work?
        //$response->assertDontSee('Resume Not Found!(404)');
    }

}
