<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\MyPackages\AuthUser;
use Tests\MyPackages\AddProfilePic;
use Tests\MyPackages\VacuumCleaner;


class ProfileTest extends TestCase
{
    use RefreshDatabase, AuthUser, AddProfilePic, VacuumCleaner;

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
    public function check_store_new_profilePic()
    {
        $response = $this->add_profile_picture();

        $response->assertSessionHas('success');
        $fileName = User::first()->profilePic;

        Storage::disk('public')->assertExists($fileName);
    }


    /** @test */
    public function check_store_new_profileName()
    {
        $user = $this->make_a_user_that_actAs_authenticated();

        $this->post(route('store_profileName'), ['name' => $user->name]);

        $this->assertEquals($user->name, User::first()->name);
    }


    /** @test */
    public function check_show_profileName_editPage()
    {
        $user = $this->make_a_user_that_actAs_authenticated();

        $this->get(route('change_profileName'))
            ->assertSee($user->name);
    }


    /** @test */
    public function check_profile_picture_in_client()
    {
        $this->add_profile_picture();

        $this->get(route('show_biography'))
            ->assertSee("/storage/");
    }


    /** @test */
    public function check_profile_picture_in_client_before_adding_profilePic()
    {
        $this->get(route('show_biography'))
            ->assertSee("/pics/default_profile.jpg");
    }


    /** @test */
    public function check_profile_picture_in_admin()
    {
        $this->add_profile_picture();

        $this->get(route('edit_biography'))
            ->assertSee("/storage/");
    }


    /** @test */
    public function check_profile_picture_in_admin_before_adding_profilePic()
    {
        $this->make_a_user_that_actAs_authenticated(['profilePicture' => null]);

        $this->get(route('edit_biography'))
            ->assertSee("/pics/default_profile.jpg");
    }


    /** @test */
    public function check_profile_name_in_client()
    {
        $user = User::factory()->create();

        $this->get(route('show_biography'))
            ->assertSee($user->name);
    }


    /** @test */
    public function check_profile_name_in_client_without_user()
    {
        $this->get(route('show_biography'))
            ->assertSee("Profile Name");
    }


    /** @test */
    public function check_profile_name_in_admin()
    {
        $user = $this->make_a_user_that_actAs_authenticated();

        $this->get(route('edit_biography'))
            ->assertSee($user->name);
    }
}
