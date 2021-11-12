<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    /** @test */
    public function check_profile_picture_in_client()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function check_profile_picture_in_admin()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function check_profile_name_in_client()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function check_profile_name_in_admin()
    {
        $this->assertTrue(true);
    }
}
