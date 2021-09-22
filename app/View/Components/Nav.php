<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use App\Models\File;

class Nav extends Component
{
    public $profileName;
    public $profilePicture;
    public function __construct()
    {
        if (User::count() > 0){
            $this->profileName = User::get()[0]->name;
        }

        $profilePicture = File::where('file_type', 'img');

        if($profilePicture->exists()){
            $profilePicturePath = $profilePicture->get()[0]->file_path;
            $this->profilePicture = '/storage/'.$profilePicturePath;
        }
    }

    public function render()
    {
        return view('components.nav');
    }
}
