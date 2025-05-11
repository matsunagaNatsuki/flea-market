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

        $request->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'postal_code' => 'required|string|max:8',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
    ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
        } else {
            $imagePath = null;
        }


            Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
            'image' => $imagePath,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
            ]);

            return redirect('/mypage/profile')->with('success', 'プロフィールを更新しました！');
    }

    public function showProfile()
    {
        return view('profile_edit');
    }
}
