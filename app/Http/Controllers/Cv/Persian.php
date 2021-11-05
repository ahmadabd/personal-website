<?php

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Cv\Language;
use App\Models\Resume;

class Persian implements Language{

    private $resumeLang = "persian";

    public function language()
    {
        $resume = Resume::where('resume_lang', $this->resumeLang);

        if($resume->exists()){
            $persian_resume_file_path = $resume->first()->file_path;

            return $persian_resume_file_path;
        }

        return false;
    }
}
