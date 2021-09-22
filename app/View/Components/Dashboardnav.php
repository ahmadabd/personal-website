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
        $this->profileName = Auth::user()->name;

        $profilePicture = Auth::user()->file()->where('file_type', 'img');

        if($profilePicture->exists()){
            $profilePicturePath = $profilePicture->get()[0]->file_path;
            $this->profilePicture = '/storage/'.$profilePicturePath;
        }
    }

    public function render()
    {
        return view('components.dashboardnav');
    }
}
