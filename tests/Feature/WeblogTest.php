<?php

namespace Tests\Feature;

use App\Models\Weblog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;

class WeblogTest extends TestCase
{
    use RefreshDatabase, AuthUser;

    public function setUp() : void
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function check_show_weblog_to_client_failed_message_when_db_isEmpty()
    {
        $response = $this->get('/weblog');

        $response->assertOk();
        $response->assertSee('Weblog Not Found!(404)');
    }

    /** @test */
    public function check_show_weblog_editPage()
    {
        $user = $this->make_a_user_that_actAs_authenticated();

        $weblog = Weblog::factory()->create(['user_id' => $user->id]);

        $this->get(route('weblog_edit'))
            ->assertSee($weblog->weblog_address);
    }

    /** @test */
    public function check_store_weblog_url()
    {
        $this->make_a_user_that_actAs_authenticated();

        $weblog = Weblog::factory()->make();

        $this->post(route('store_weblog'), ['weblog_address' => $weblog->weblog_address]);

        $this->assertCount(1, Weblog::all());
    }

    /** @test */
    public function check_store_weblog_url_validation()
    {
        $this->withExceptionHandling();
        $this->make_a_user_that_actAs_authenticated();

        $weblog = Weblog::factory()->make(['weblog_address' => 'test']);

        $response = $this->post(route('store_weblog'), ['weblog_address' => $weblog->weblog_address]);

        $response->assertSessionHasErrors('weblog_address');
    }

    /** @test */
    public function check_weblog_auth()
    {
        Weblog::factory()->create();

        $response = $this->get(route('weblog_edit'));

        $response->assertRedirect($response->headers->get('Location'));
    }
}
