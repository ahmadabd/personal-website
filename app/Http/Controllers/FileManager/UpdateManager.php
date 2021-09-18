<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\FileManager\ProfilePicture;
use App\Http\Controllers\FileManager\PersianResume;
use App\Http\Controllers\FileManager\BookPicture;


/*
 * its for updating new file, means delete old file then add new file.
 */
class UpdateManager {
    private static $uploaderClasses = [
        'profile_picture' => ProfilePicture::class,
        'persian_resume'  => PersianResume::class,
        'book_picture'    => BookPicture::class
    ];

    public function choose_uploader_class($selectedClass, $file, $id)
    {
        (new self::$uploaderClasses[$selectedClass])->remove_old_file($id);
        $storedFile = (new self::$uploaderClasses[$selectedClass])->add_new_file($file, $id);

        return $storedFile;
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected uploader class is not in $uploaderClasses return error
        if (!array_key_exists($name, self::$uploaderClasses)){

            dd("{$name} is Invalid method");
        }

        return (new UpdateManager)->choose_uploader_class($name, $arguments[0], $arguments[1]);
    }
}
