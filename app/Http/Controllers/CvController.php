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
use App\Models\Resume;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    public function show_resume_to_client()
    {
        $resumeFilePath = chooseResume::persian_resume();

        if ($resumeFilePath){
            /**
             * After installing Octane, Reading resume from storage/ failed
             * So I make new way to do that by reading it from Storage::path
             */
            try{
                $resumeFile = response()->file('storage/'.$resumeFilePath);
            } catch(\Exception $exception){
                $resumeFile = response()->file(Storage::path('public/'.$resumeFilePath));
            } catch(\Exception $exception){
                throw new ResumeException();
            }
            return $resumeFile;
        }
        else{
            throw new ResumeException();
        }
    }


    public function show_resume_editPage()
    {
        $resumes = Auth::user()->resumes;

        $isResume = ($resumes->count()) ? true : false;

        return view('resume_editPage', ['isResume' => $isResume, 'resumes' => $resumes]);
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


    public function delete_old_resume(Resume $resume)
    {
        $deletedResumeFile = DeleteManager::persian_resume($resume->user_id);
        $deletedResume = $resume->delete();

        SuccessOrFailMessage::SuccessORFail($deletedResume && $deletedResumeFile);

        return redirect()->route('resume_editPage');
    }
}
