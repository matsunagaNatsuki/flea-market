<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function mypage()
    {
        return view('profile');
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
            $user->name =$request->name;
            $user->postal = $request->address;
            $user->build = $request->build;

            $user->save();

            return view('profile_edit');
        }
    }

    public function showProfile()
    {
        return view('profile_edit');
    }
}
