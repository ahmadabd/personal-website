<?php

namespace Tests\Feature;

use App\Models\Bio;
use App\Models\User;
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
        $this->make_a_user_that_actAs_authenticated();

        // Second Store value to DB
        $this->post(route('store_biography'), [
            'biography' => 'test'
        ]);

        $response = $this->get(
            route('show_biography')
        );

        // Check stored value is return to view or not
        $response->assertSee('test');
    }


    /** @test */
    public function check_show_biography_editPage_is_available_or_not()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();

        $this->make_a_user_that_actAs_authenticated();

        // ?????????????????
        $response = $this->get(
            route('edit_biography')
        );

        $response->assertOk();
    }


    /** @test */
    public function check_store_biography_validation()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();

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
        $this->withoutMiddleware();

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
