<?php

namespace App\Http\Controllers\UploadFile;

interface FileImp {
    public function remove_old_file($userId);
    public function add_new_file($file, $userId);
}