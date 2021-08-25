<?php

namespace App\Http\Controllers\UploadFile;

use App\Http\Controllers\UploadFile\ProfilePicture;

class UploadManager {
    private static $uploaderClasses = [
        'profile_picture' => ProfilePicture::class
    ];

    public function choose_uploader_class($selectedClass, $file)
    {
        $removeOldFile = (new self::$uploaderClasses[$selectedClass])->remove_old_file();
        $addnewFile = (new self::$uploaderClasses[$selectedClass])->add_new_file($file);
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected uploader class is not in $uploaderClasses return error
        if (!array_key_exists($name, self::$uploaderClasses)){
            
            dd("{$name} is Invalid method");
        }   

        return (new UploadManager)->choose_uploader_class($name, $arguments[0]);
    }
}