<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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

    public function showProfile()
    {
        $profile = Profile::where('user_id', Auth::id())->first();

        return view('profile_edit');
    }

    public function editProfile(Request $request)
    {
        $profile = Profile::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building ?? null,
            'image' => $request->hasFile('image') ? $request->file('image')->store('profiles', 'public'): (Auth::User()->profile->image ?? null),
        ]);
        return redirect()->route('/');
    }
}



