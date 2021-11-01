<?php

namespace App\Http\Controllers\Classes;
use App\Models\User;


class ProfilePicStoreClass {
    public static function create($fileData, $userId)
    {
        $storedProfilePicture = User::find($userId)->update([
            'profilePicture' => $fileData['filePath']
        ]);

        return $storedProfilePicture;
    }
}
