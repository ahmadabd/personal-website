<?php

namespace Tests\MyPackages;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait AddProfilePic {
    public function add_profile_picture()
    {
        $this->make_a_user_that_actAs_authenticated();

        // Store new book
        Storage::fake('public');
        $this->file = UploadedFile::fake()->image('test.jpg');

        $response = $this->post(route('store_profilePic'), ['profilePic' => $this->file]);

        return $response;
    }
}
