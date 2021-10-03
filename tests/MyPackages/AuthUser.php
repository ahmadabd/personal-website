<?php

namespace Tests\MyPackages;
use App\Models\User;

trait AuthUser {
    public function make_a_user_that_actAs_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
    }
}
