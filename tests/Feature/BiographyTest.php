<?php

namespace Tests\Feature;

use App\Models\Bio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;
use Tests\MyPackages\VacuumCleaner;


class BiographyTest extends TestCase
{
    use RefreshDatabase;
    use AuthUser;
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
    public function check_show_biography_to_client_failed_message_when_db_is_empty()
    {
        $response = $this->get(
            route('show_biography')
        );

        $response->assertOk();
        $response->assertSessionHas('failed');
    }


    /** @test */
    public function check_show_biography_to_client_when_db_is_not_Empty()
    {
        $user = $this->make_a_user_that_actAs_authenticated();

        Bio::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->get(
            route('show_biography')
        );

        // Check stored value is return to view or not
        $response->assertSee('test');
    }


    /** @test */
    public function check_show_biography_editPage_when_db_is_not_empty()
    {
        $user = $this->make_a_user_that_actAs_authenticated();

        Bio::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->get(
            route('edit_biography')
        );

        $response->assertSee("test");
    }


    /** @test */
    public function check_show_biography_editPage_when_db_is_empty()
    {
        $user = $this->make_a_user_that_actAs_authenticated();

        $response = $this->get(
            route('edit_biography')
        );

        $response->assertSee("Biography");
    }


    /** @test */
    public function check_store_biography()
    {
        $this->make_a_user_that_actAs_authenticated();

        $response = $this->post(route('store_biography'), [
            'biography' => "test"
        ]);

        $response->assertRedirect(
            route('edit_biography')
        );

        $this->assertCount(1, Bio::all());
        $this->assertEquals('test', Bio::get()[0]->biography);
        $response->assertSessionHas('success');
    }
}
