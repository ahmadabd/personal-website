<?php

namespace App\Http\Controllers\UploadFile;

interface Uploader {
    public function remove_old_file($fileType);
    public function add_new_file($file, $fileType);
}