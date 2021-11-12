<?php

namespace Tests\MyPackages;
use App\Models\User;

trait AuthUser {
    public function make_a_user_that_actAs_authenticated($fields = [])
    {
        $user = User::factory()->create($fields);
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        return $user;
    }
}
