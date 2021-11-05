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
        if (User::exists()){
            $this->profileName = User::first()->name;

            if (User::first()->profilePicture != null) {
                $this->profilePicture = '/storage/'.User::get()[0]->profilePicture;
            }
        }
    }

    public function render()
    {
        return view('components.nav');
    }
}
