<?php

namespace App\Http\Controllers;

use App\Exceptions\ResumeException;
use App\Http\Controllers\Cv\chooseResume;
use App\Http\Requests\ResumeRequest;
use App\Http\Controllers\FileManager\UploadManager;
use App\Http\Controllers\FileManager\DeleteManager;
use App\Http\Controllers\FlashMessage\Message;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    public function show_resume_to_client()
    {   
        /**
         * Show Resume file to client
         */

        $resumeFilePath = chooseResume::persian_resume();

        try{
            $resumeFile = response()->file($resumeFilePath);
        } catch(\Exception $exception){
            throw new ResumeException();
        }
        
        return $resumeFile;
    }


    public function show_resume_editPage()
    {
        /**
         * Show resume edit page to admin.
         * if old resume exists isResume equals to true else false
         */
        $isResume = Auth::user()->file()->exists("persian_pdf");

        return view('resume_editPage', ['isResume' => $isResume]);
    }


    public function store_new_resume(ResumeRequest $request)
    {
        /**
         * Store new resume file in database
         */
        $userId = auth()->user()->id;

        if ($request->file()){
            $resumeFile = $request->file('resumeFile');
            UploadManager::persian_resume($resumeFile, $userId);
            Message::success("New Resume Successfully Added.");
        }
        
        return redirect()->route('resume_editPage');
    }


    public function delete_old_resume()
    {
        $userId = auth()->user()->id;

        DeleteManager::persian_resume($userId);
        Message::success("Resume successfully deleted.");

        return redirect()->route('resume_editPage');
    }
}
