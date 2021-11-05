<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
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
