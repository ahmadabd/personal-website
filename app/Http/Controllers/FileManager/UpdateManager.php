<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\FileManager\ProfilePicture;
use App\Http\Controllers\FileManager\PersianResume;
use App\Http\Controllers\FileManager\BookPicture;


/*
 * its for updating new file, First delete the old file then add new file.
 */
class UpdateManager {
    private static $classes = [
        'profile_picture' => ProfilePicture::class,
        'persian_resume'  => PersianResume::class,
        'book_picture'    => BookPicture::class
    ];

    public function choose_uploader_class(FileImp $fileClass, $file, $id)
    {
        $fileClass->remove_old_file($id);
        return $fileClass->add_new_file($file);
    }

    public static function __callStatic($name, $arguments)
    {
        if (!array_key_exists($name, self::$classes)){
            dd("{$name} is Invalid method");
        }

        return (new UpdateManager)->choose_uploader_class(
            new self::$classes[$name],
            $arguments[0],
            $arguments[1]
        );
    }
}
