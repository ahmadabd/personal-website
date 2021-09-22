<?php

namespace App\Http\Controllers\Classes;
use App\Models\File;

class CvStoreClass {
    public static function create($userId, $fileData)
    {
        $storedResume = File::create([
            'user_id'   => $userId,
            'name'      => $fileData['fileName'],
            'file_path' => $fileData['filePath'],
            'file_type' => $fileData['fileType']
        ]);

        return $storedResume->exists();
    }
}
