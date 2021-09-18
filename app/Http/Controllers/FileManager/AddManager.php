<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\FileManager\BookPicture;


/*
 * its just for adding new File
 */
class AddManager {
    private static $uploaderClasses = [
        'book_picture'    => BookPicture::class
    ];

    public function choose_uploader_class($selectedClass, $file, $id)
    {
        $storedFile = (new self::$uploaderClasses[$selectedClass])->add_new_file($file, $id);

        return $storedFile;
    }

    public static function __callStatic($name, $arguments)
    {
        // Check if selected uploader class is not in $uploaderClasses return error
        if (!array_key_exists($name, self::$uploaderClasses)){

            dd("{$name} is Invalid method");
        }

        return (new AddManager)->choose_uploader_class($name, $arguments[0], $arguments[1]);
    }
}
