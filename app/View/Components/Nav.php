<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class Nav extends Component
{
    public $profileName;
    public function __construct()
    {
        // Get profile Name from User.name
        $this->profileName = User::get('name')[0]['name'];
    }
    
    public function render()
    {
        return view('components.nav');
    }
}
