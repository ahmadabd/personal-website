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
        if (User::count() > 0){
            $this->profileName = User::get()[0]->name;
            $profilePicture = User::get()[0]->profilePicture;
        }

        if($profilePicture !== null){
            $this->profilePicture = '/storage/'.$profilePicture;
        }
    }

    public function render()
    {
        return view('components.nav');
    }
}
