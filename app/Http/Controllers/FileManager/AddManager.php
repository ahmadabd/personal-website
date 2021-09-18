<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\FileManager\BookPicture;


/*
 * its just for adding new File
 */
class AddManager {
    private static $classes = [
        'book_picture'    => BookPicture::class
    ];

    public function choose_uploader_class(FileImp $fileClass, $file, $id)
    {
        return $fileClass->add_new_file($file, $id);
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected uploader class is not in $uploaderClasses return error
        if (!array_key_exists($name, self::$classes)){

            dd("{$name} is Invalid method");
        }

        return (new AddManager)->choose_uploader_class(
            new self::$classes[$name],
            $arguments[0],
            $arguments[1]
        );
    }
}
