<?php

namespace App\Http\Controllers\UploadFile;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PersianResume implements Uploader{
    
    private $FileStorePath = 'cv';
    private $fileType = "persian_pdf";

    public function remove_old_file(){
        // delete old resume
        if(File::where('file_type', $this->fileType)->count() > 0){
            
            $oldProfilePath = File::where('file_type', $this->fileType)->get()[0]['file_path'];
            
            // Delete old profile picture from Database
            File::where('file_path', $oldProfilePath)->delete();
            
            if (Storage::disk('public')->exists($oldProfilePath)){
                    
                // Delete old profile picture from storage/public/profile
                Storage::disk('public')->delete($oldProfilePath);
            }
        }
    }
    
    public function add_new_file($file){
        $spliteFile = explode(".", $file->getClientOriginalName());
        $fileFormat = end($spliteFile);
        
        $randomFileName = Str::random(10);
        $fileName = $randomFileName.'.'.$fileFormat;

        // Picture stores in /storage/public/profile
        $filePath = $file->storeAs($this->FileStorePath, $fileName, 'public');
        
        File::create([
            'name' => $fileName,
            'file_path' => $filePath,
            'file_type' => $this->fileType
        ]);
    }
}