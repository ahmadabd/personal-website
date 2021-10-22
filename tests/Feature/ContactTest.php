<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;
use Tests\MyPackages\ContactMePost;

class ContactTest extends TestCase
{
    use RefreshDatabase;
    use AuthUser;
    use WithFaker;
    use ContactMePost;

    /** @test */
    public function check_show_contactMe_to_client_failed_message_when_db_isEmpty()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/contact');

        $response->assertOk();
        $response->assertSessionHas('failed');
    }


    /** @test */
    public function check_show_contactMe_to_client_when_db_is_not_empty()
    {
        $this->withoutExceptionHandling();

        $email = "test@gmail.com";
        $this->send_data_to_contactMe_store($email);

        $response = $this->get('/contact');

        $response->assertOk();
        $response->assertSee($email);
    }


    /** @test */
    public function check_show_contactMe_edit_availibility()
    {
        $this->withoutExceptionHandling();

        $this->make_a_user_that_actAs_authenticated();

        $response = $this->get(route('show_contactMe_edit'));

        $response->assertSee("Edit Contact Me");
    }


    /** @test */
    public function check_show_contactMe_edit_availibility_with_full_DB()
    {
        $this->withoutExceptionHandling();

        $email = "testemail@gmail.com";
        $this->send_data_to_contactMe_store($email);

        $response = $this->get(route('show_contactMe_edit'));

        $response->assertSee($email);
    }


    /** @test */
    public function check_store_contactMe()
    {
        $this->withoutExceptionHandling();

        $response = $this->send_data_to_contactMe_store();

        $response->assertRedirect(
            route('show_contactMe_edit')
        );
    }
}
