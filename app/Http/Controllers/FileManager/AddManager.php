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

    public function choose_uploader_class(FileImp $fileClass, $file)
    {
        return $fileClass->add_new_file($file);
    }

    public static function __callStatic($name, $arguments)
    {
        if (!array_key_exists($name, self::$classes)){
            dd("{$name} is Invalid method");
        }

        return (new AddManager)->choose_uploader_class(
            new self::$classes[$name],
            $arguments[0]
        );
    }
}
