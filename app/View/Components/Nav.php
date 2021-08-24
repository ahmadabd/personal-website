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
        $this->profileName = User::get('name')[0]['name'];

        // Get profile Picture from File Model
        if(File::where('file_type', 'img')->count() > 0){
            $profilePicturePath = File::where('file_type', 'img')->get()[0]['file_path'];
            $this->profilePicture = $profilePicturePath;
        }
    }
    
    public function render()
    {
        return view('components.nav');
    }
}
