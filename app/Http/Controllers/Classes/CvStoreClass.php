<?php

namespace App\Http\Controllers\Classes;
use App\Models\Resume;

class CvStoreClass {
    public static function create($userId, $fileData)
    {
        $storedResume = Resume::create([
            'user_id'   => $userId,
            'file_path' => $fileData['filePath'],
            'resume_lang' => $fileData['resume_lang']
        ]);

        return $storedResume->exists();
    }
}
