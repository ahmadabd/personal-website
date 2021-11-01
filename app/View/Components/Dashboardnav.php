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
        $this->profileName = Auth::user()->name ?? "Profile Name";

        $this->profilePicture = '/storage/'.Auth::user()->profilePicture ?? "/pics/default_profile.jpg";
    }

    public function render()
    {
        return view('components.dashboardnav');
    }
}
