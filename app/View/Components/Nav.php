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
        // Get profile Name from User.name Model
        if (User::count() > 0){
            $this->profileName = User::get()[0]->name;
        }

        // Get profile Picture from File Model
        $fileObject = File::where('file_type', 'img');

        if($fileObject->exists()){
            $profilePicturePath = $fileObject->get()[0]->file_path;
            $this->profilePicture = 'storage/'.$profilePicturePath;
        }
    }
    
    public function render()
    {
        return view('components.nav');
    }
}
