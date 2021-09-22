<?php

namespace App\Http\Controllers\Classes;
use App\Models\File;


class ProfilePicStoreClass {
    public static function create($fileData, $userId)
    {
        $storedProfilePicture = File::create([
            'user_id'   => $userId,
            'name'      => $fileData['fileName'],
            'file_path' => $fileData['filePath'],
            'file_type' => $fileData['fileType']
        ]);

        return $storedProfilePicture->exists();
    }
}
