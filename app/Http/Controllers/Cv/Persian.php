<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Language;
use App\Models\File;

class Persian implements Language{

    private $fileType = "persian_pdf";

    public function language()
    {
        $file = File::where('file_type', $this->fileType);

        if($file->exists()){
            $persian_resume_file_path = $file->get()[0]->file_path;

            // return 'storage/'.$persian_resume_file_path;
            return 'public/'.$persian_resume_file_path;
        }

        return false;
    }
}
