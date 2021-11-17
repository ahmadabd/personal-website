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

        if (Auth::user()->profilePicture != null){
            $this->profilePicture = '/storage/'.Auth::user()->profilePicture;
        }
    }

    public function render()
    {
        return view('components.dashboardnav');
    }
}
