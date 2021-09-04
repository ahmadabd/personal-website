<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Language;
use App\Models\File;

class Persian implements Language{

    private $fileType = "persian_pdf";

    public function language()
    {
        $file = File::where('file_type', $this->fileType);

        // Get persian resume from File Model
        if($file->exists()){
            
            $profilePicturePath = $file->get()[0]->file_path;
            $profilePicture = 'storage/'.$profilePicturePath;
            
            return $profilePicture;
        }
    }
}   