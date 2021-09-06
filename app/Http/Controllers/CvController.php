<?php

namespace App\Http\Controllers;

use App\Exceptions\ResumeException;
use App\Http\Controllers\Cv\chooseResume;
use App\Http\Requests\ResumeRequest;
use App\Http\Controllers\UploadFile\UploadManager;
use App\Http\Controllers\UploadFile\DeleteManager;
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
         * Show resume edit page to admin
         */
        return view('resume_editPage');
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
        $files = Auth::user()->file()->get();
        $userId = auth()->user()->id;

        foreach ($files as $file){
            if ($file->file_type == "persian_pdf"){
                DeleteManager::persian_resume($userId);
                Message::success("Resume successfully deleted.");
            }
            else{
                Message::failed("You dont have any resume to delete.");
            }
        }

        return redirect()->route('resume_editPage');
    }
}
