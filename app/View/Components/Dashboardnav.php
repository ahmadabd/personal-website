<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use App\Models\File;

class DashboardNav extends Component
{
    public $profileName;
    public $profilePicture;
    public function __construct()
    {
        $userId = auth()->user()->id;

        // Get profile Name from User.name Model
        $this->profileName = User::findorFail($userId)->get('name')[0]['name'];
    
        // Get profile Picture from File Model
        if(File::where('user_id', $userId)->where('file_type', 'img')->count() > 0){
            $profilePicturePath = File::where('user_id', $userId)->
                where('file_type', 'img')->get()[0]['file_path'];
            $this->profilePicture = 'storage/'.$profilePicturePath;
        }
    }

    public function render()
    {
        return view('components.dashboardnav');
    }
}
