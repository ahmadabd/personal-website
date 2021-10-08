<?php

namespace Tests\Feature;

use App\Models\Bio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;


class BiographyTest extends TestCase
{
    use RefreshDatabase;
    use AuthUser;

    /** @test */
    public function check_show_biography_to_client_failed_message_when_db_is_empty()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(
            route('show_biography')
        );

        $response->assertOk();
        $response->assertSessionHas('failed');
    }


    /** @test */
    public function check_show_biography_to_client_when_db_is_not_Empty()
    {
        $this->withoutExceptionHandling();

        // First make and authenticate a user
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
        $this->withoutExceptionHandling();

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
        $this->withoutExceptionHandling();

        $user = $this->make_a_user_that_actAs_authenticated();

        $response = $this->get(
            route('edit_biography')
        );

        $response->assertSee("Biography");
    }


    /** @test */
    public function check_store_biography_validation()
    {
        $this->withoutExceptionHandling();

        $this->make_a_user_that_actAs_authenticated();

        $response = $this->post(route('store_biography'), [
            'biography' => 'test'
        ]);

        $response->assertSessionHasNoErrors();
    }


    /** @test */
    public function check_store_biography()
    {
        $this->withoutExceptionHandling();

        $this->make_a_user_that_actAs_authenticated();

        $response = $this->post(route('store_biography'), [
            'biography' => "test"
        ]);

        $response->assertRedirect(
            route('edit_biography')
        );
        $this->assertCount(1, Bio::all());

        $response->assertSessionHas('success');
    }
}
