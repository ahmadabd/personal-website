<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;
use Tests\MyPackages\AddResume;
use App\Models\Resume;
use Illuminate\Support\Facades\Storage;
use Tests\MyPackages\VacuumCleaner;


class ResumeTest extends TestCase
{
    use RefreshDatabase;
    use AuthUser;
    use AddResume;
    use VacuumCleaner;

    public function setUp() : void
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    public function tearDown() : void
    {
        parent::tearDown();

        $this->clearProperties();
    }

    /** @test */
    public function check_show_resume_to_client_failed_message_when_db_isEmpty()
    {
        $response = $this->get(route('show_cv'));

        $response->assertOk();
        $response->assertSee('Resume Not Found!(404)');
    }

    /** @test */
    public function check_store_new_resume()
    {
        $this->store_new_resume();
    }

    /** @test */
    public function check_show_resume_editPage()
    {
        $this->make_a_user_that_actAs_authenticated();

        $response = $this->get(route('resume_editPage'));
        $response->assertSee('Add your new resume');
    }

    /** @test */
    public function check_show_resume_editPage_when_db_is_not_empty()
    {
        $this->store_new_resume();
        $response = $this->get(route('resume_editPage'));
        $response->assertSee('Delete persian');
    }

    /** @test */
    public function check_delete_old_resume()
    {
        $resume = $this->store_new_resume();
        $resumeName = $resume->file_path;

        $this->delete(route('delete_resume', ['resume' => $resume->id]));

        $this->assertCount(0, Resume::all());
        Storage::disk('public')->assertMissing($resumeName);
    }
}
