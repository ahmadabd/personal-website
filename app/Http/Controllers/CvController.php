<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Cv\chooseResume;
use App\Http\Requests\ResumeRequest;
use App\Http\Controllers\UploadFile\UploadManager;
use App\Http\Controllers\FlashMessage\Message;


class CvController extends Controller
{
    public function selectLanguage()
    {
        # Show page to Select between language do you need to see resume??? 
    }
    

    public function show_resume_to_client(Request $request)
    {   
        // Get language from selectLanguage() method
        $resumeAddress = chooseResume::persian();

        $resumeFile = response()->file($resumeAddress);

        if (! $resumeFile ){
            abort(404);
        }
                
        return $resumeFile;
    }

    public function show_resume_editPage()
    {
        return view('cv_editPage');
    }

    public function store_new_resume(ResumeRequest $request)
    {
        if ($request->file()){
            $fileUploaded = UploadManager::persian_resume($request->file('resumeFile'));
            Message::success("New Resume Successfully Changed.");
        }
        
        return redirect()->route('resume_editPage');
    }
}
