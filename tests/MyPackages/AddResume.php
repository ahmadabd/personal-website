<?php

namespace Tests\MyPackages;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Resume;


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

        $this->assertEquals(1, Resume::count());

        $file = Resume::first();
        Storage::disk('public')->assertExists("cv/{$file->name}");

        return $file;
    }
}
