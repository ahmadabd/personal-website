<?php

namespace App\Http\Controllers\UploadFile;

use App\Http\Controllers\UploadFile\ProfilePicture;
use App\Http\Controllers\UploadFile\PersianResume;


class DeleteManager {
    private static $deleterClasses = [
        'profile_picture' => ProfilePicture::class,
        'persian_resume'  => PersianResume::class
    ];

    public function choose_deleter_class($selectedClass, $userId)
    {
        $removeOldFile = (new self::$deleterClasses[$selectedClass])->remove_old_file($userId);
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected deleter class is not in $deleterClasses return error
        if (!array_key_exists($name, self::$deleterClasses)){
            
            dd("{$name} is Invalid method");
        }   

        return (new DeleteManager)->choose_deleter_class($name, $arguments[0]);
    }
}