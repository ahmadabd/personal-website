<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function show()
    {
        return view('aboutMe');
    }
}
