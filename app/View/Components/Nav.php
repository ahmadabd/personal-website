<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class Nav extends Component
{
    public $profileName;
    public $profilePicture;
    public function __construct()
    {
        $this->profileName = "Profile Name";
        $this->profilePicture = "/pics/default_profile.jpg";

        if (User::count() > 0){
            $this->profileName = User::get()[0]->name;
            $this->profilePicture = '/storage/'.User::get()[0]->profilePicture;
        }
    }

    public function render()
    {
        return view('components.nav');
    }
}
