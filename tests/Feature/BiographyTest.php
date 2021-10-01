<?php

namespace Tests\Feature;

use App\Models\Bio;
use App\Models\User;
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


    /** @test */
    public function check_store_biography_validation()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        $response = $this->post('/admin/dashboard', [
            'biography' => 'test'
        ]);

        //$response->assertSessionHasErrors('biography');
        $response->assertSessionHasNoErrors();
    }


    /** @test */
    public function check_store_biography()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        $response = $this->post('/admin/dashboard', [
            'biography' => "test"
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertCount(1, Bio::all());

        $response->assertSessionHas('success');
    }

}
