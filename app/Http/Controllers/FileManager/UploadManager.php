<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\FileManager\ProfilePicture;
use App\Http\Controllers\FileManager\PersianResume;


class UploadManager {
    private static $uploaderClasses = [
        'profile_picture' => ProfilePicture::class,
        'persian_resume'  => PersianResume::class
    ];

    public function choose_uploader_class($selectedClass, $file, $userId)
    {
        $removeOldFile = (new self::$uploaderClasses[$selectedClass])->remove_old_file($userId);
        $addnewFile = (new self::$uploaderClasses[$selectedClass])->add_new_file($file, $userId);
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected uploader class is not in $uploaderClasses return error
        if (!array_key_exists($name, self::$uploaderClasses)){
            
            dd("{$name} is Invalid method");
        }   

        return (new UploadManager)->choose_uploader_class($name, $arguments[0], $arguments[1]);
    }
}