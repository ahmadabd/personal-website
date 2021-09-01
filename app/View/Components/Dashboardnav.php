<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;


class DashboardNav extends Component
{
    public $profileName;
    public $profilePicture;
    public function __construct()
    {
        // Get profile Name from User.name Model
        $this->profileName = Auth::user()->name;

        // Get profile Picture from File Model
        $fileObject = Auth::user()->file()->where('file_type', 'img');
        
        if($fileObject->exists()){
            $profilePicturePath = $fileObject->get()[0]['file_path'];
            $this->profilePicture = 'storage/'.$profilePicturePath;
        }
    }

    public function render()
    {
        return view('components.dashboardnav');
    }
}
