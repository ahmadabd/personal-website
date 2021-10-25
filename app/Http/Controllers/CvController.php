<?php

namespace App\Http\Controllers;

use App\Exceptions\ResumeException;
use App\Http\Controllers\Cv\chooseResume;
use App\Http\Requests\ResumeRequest;
use App\Http\Controllers\FileManager\UpdateManager;
use App\Http\Controllers\FileManager\DeleteManager;
use App\Http\Controllers\FlashMessage\SuccessOrFailMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Classes\CvStoreClass;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    public function show_resume_to_client()
    {
        $resumeFilePath = chooseResume::persian_resume();

        try{
            // $resumeFile = response()->file($resumeFilePath);
            $resumeFile = response()->file(Storage::path($resumeFilePath));
        } catch(\Exception $exception){
            throw new ResumeException();
        }

        return $resumeFile;
    }


    public function show_resume_editPage()
    {
        $files = Auth::user()->file()->get();
        $isResume = false;

        foreach ($files as $f){
            if ($f->file_type == "persian_pdf") {
                $isResume = true;
            }
        }

        return view('resume_editPage', ['isResume' => $isResume]);
    }


    public function store_new_resume(ResumeRequest $request)
    {
        $userId = auth()->user()->id;

        if ($request->file()){
            $resumeFile = $request->file('resumeFile');
            $fileData = UpdateManager::persian_resume($resumeFile, $userId);

            $storedResume = CvStoreClass::create($userId, $fileData);

            SuccessOrFailMessage::SuccessORFail($storedResume);
        }

        return redirect()->route('resume_editPage');
    }


    public function delete_old_resume()
    {
        $userId = auth()->user()->id;

        $deletedResume = DeleteManager::persian_resume($userId);
        SuccessOrFailMessage::SuccessORFail($deletedResume);

        return redirect()->route('resume_editPage');
    }
}
