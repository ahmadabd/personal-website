<?php

namespace App\Http\Controllers;

use App\Exceptions\ResumeException;
use Illuminate\Http\Request;

use App\Http\Controllers\Cv\chooseResume;
use App\Http\Requests\ResumeRequest;
use App\Http\Controllers\UploadFile\UploadManager;
use App\Http\Controllers\FlashMessage\Message;


class CvController extends Controller
{
    public function show_resume_to_client(Request $request)
    {   
        // Get language from selectLanguage() method
        $resumeAddress = chooseResume::persian_resume();

        try{
            $resumeFile = response()->file($resumeAddress);
        } catch(\Exception $exception){
            throw new ResumeException();
        }
        
        return $resumeFile;
    }

    public function show_resume_editPage()
    {
        return view('resume_editPage');
    }

    public function store_new_resume(ResumeRequest $request)
    {
        if ($request->file()){
            $resumeFile = $request->file('resumeFile');
            UploadManager::persian_resume($resumeFile);
            Message::success("New Resume Successfully Added.");
        }
        
        return redirect()->route('resume_editPage');
    }
}
