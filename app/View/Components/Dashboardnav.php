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

        $profilePicture = Auth::user()->profilePicture;

        if($profilePicture !== null){
            $this->profilePicture = '/storage/'.$profilePicture;
        }
    }

    public function render()
    {
        return view('components.dashboardnav');
    }
}
