<?php

namespace Tests\MyPackages;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\File;


trait AddResume {
    public function store_new_resume()
    {
        $this->make_a_user_that_actAs_authenticated();

        Storage::fake('public');

        $sizeInKB = 1024;
        $file = UploadedFile::fake()->create(
            'document.pdf',
            $sizeInKB,
            'application/pdf'
        );

        $response = $this->post(route('store_resume'), [
            "resumeFile" => $file
        ]);

        $response->assertRedirect(route('resume_editPage'));

        $this->assertEquals(1, File::count());

        $fileName = File::get()[0]->name;
        Storage::disk('public')->assertExists("cv/{$fileName}");

        return $response;
    }
}
