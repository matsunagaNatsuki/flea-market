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
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('profile', compact('profile'));
    }

    public function showProfile()
    {
        $profile = Profile::where('user_id', Auth::id())->first();

        return view('profile_edit');
    }

    public function editProfile(Request $request)
    {
        $profile = Profile::where('user_id', Auth::id())->first();

        if($profile) {
            $profile->update([
                'name' => $request->name,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building ?? null,
                'image' => $request->hasFile('image') ? $request->file('image')->store('profiles', 'public') : ($profile->image ?? 'default-avatar.png'),
            ]);
        }

        else {
            Profile::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building ?? null,
                'image' => $request->hasFile('image') ? $request->file('image')->store('profiles', 'public') : '—Pngtree—cat default avatar_5416936.png',
            ]);
        }

        return redirect('/mypage');
    }

}



