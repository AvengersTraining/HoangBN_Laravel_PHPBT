<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        // Do something
    }

    public function profile()
    {
        return view('user/profile');
    }
}
