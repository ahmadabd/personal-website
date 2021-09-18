<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\FileManager\ProfilePicture;
use App\Http\Controllers\FileManager\PersianResume;
use App\Http\Controllers\FileManager\BookPicture;

/*
 * it uses for delete old file
 */
class DeleteManager {
    private static $classes = [
        'profile_picture' => ProfilePicture::class,
        'persian_resume'  => PersianResume::class,
        'book_picture'    => BookPicture::class
    ];

    public function choose_deleter_class(FileImp $fileClass, $id)
    {
        return $fileClass->remove_old_file($id);
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected deleter class is not in $deleterClasses return error
        if (!array_key_exists($name, self::$classes)){

            dd("{$name} is Invalid method");
        }

        return (new DeleteManager)->choose_deleter_class(
            new self::$classes[$name],
            $arguments[0]
        );
    }
}
