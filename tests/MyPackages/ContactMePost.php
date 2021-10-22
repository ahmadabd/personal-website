<?php

namespace Tests\MyPackages;

use App\Models\Contact;


trait ContactMePost {
    public function send_data_to_contactMe_store(
        $email      = null,
        $linkedin   = null,
        $twitter    = null,
        $instagram  = null,
        $github     = null,
        $telegram   = null )
    {
        $this->make_a_user_that_actAs_authenticated();

        $response = $this->post(route('store_contactMe'), [
            "email"     => $email       ?? $this->faker->email(),
            "linkedin"  => $linkedin    ?? $this->faker->url(),
            "twitter"   => $twitter     ?? $this->faker->url(),
            "instagram" => $instagram   ?? $this->faker->url(),
            "github"    => $github      ?? $this->faker->url(),
            "telegram"  => $telegram    ?? $this->faker->url()
        ]);

        $response->assertSessionHas("success");
        $this->assertEquals(1, Contact::count());

        return $response;
    }
}
