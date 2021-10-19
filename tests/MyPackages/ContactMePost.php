<?php

namespace Tests\MyPackages;

use App\Models\Contact;


trait ContactMePost {
    public function send_data_to_contactMe_store()
    {
        $this->make_a_user_that_actAs_authenticated();

        $response = $this->post(route('store_contactMe'), [
            "email"     => $this->faker->email(),
            "linkedin"  => $this->faker->url(),
            "twitter"   => $this->faker->url(),
            "instagram" => $this->faker->url(),
            "github"    => $this->faker->url(),
            "telegram"  => $this->faker->url()
        ]);

        $response->assertSessionHas("success");
        $this->assertEquals(1, Contact::count());

        return $response;
    }
}
