<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Language;
use app\Models\File;

class Persian implements Language{

    private $fileType = "persian_pdf";

    public function language() : string
    {
        
        // Get persian resume from File Model
        if(File::where('file_type', $this->fileType)->count() > 0){
            
            $profilePicturePath = File::where('file_type', $this->fileType)->get()[0]['file_path'];
            $profilePicture = 'storage/'.$profilePicturePath;
            
            return $profilePicture;
        }
    }
}   