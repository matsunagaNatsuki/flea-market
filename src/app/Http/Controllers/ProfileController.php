<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function mypage()
    {
        return view('profile');
    }


    public function edit_profile()
    {
        return view('profile_edit');
    }

}


