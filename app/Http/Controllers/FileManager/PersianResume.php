<?php

namespace App\Http\Controllers\FileManager;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Resume;

class PersianResume implements FileImp {

    private $FileStorePath = 'cv';
    private $resumeLang = "persian";

    public function remove_old_file($userId){
        $resume = Resume::where('user_id', $userId)->where('resume_lang', $this->resumeLang);

        if($resume->exists()){

            $oldProfilePath = $resume->first()->file_path;

            Resume::where('file_path', $oldProfilePath)->delete();

            if (Storage::disk('public')->exists($oldProfilePath)){
                Storage::disk('public')->delete($oldProfilePath);
            }

            return true;
        }

        return false;
    }


    public function add_new_file($file){

        $spliteFile = explode(".", $file->getClientOriginalName());
        $fileFormat = end($spliteFile);

        $randomFileName = Str::random(10);
        $fileName = $randomFileName.'.'.$fileFormat;

        // Picture stores in /storage/public/cv
        $filePath = $file->storeAs($this->FileStorePath, $fileName, 'public');

        return [
            "filePath" => $filePath,
            "resume_lang" => $this->resumeLang,
        ];
    }
}
