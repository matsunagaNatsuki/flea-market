<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function mypage()
    {
        return view('profile');
    }

    public function edit_profile(Request $request)
    {
        $user = auth()->user();

        if ($request->isMethod('post')) {
            $request->validate([
            'name' => 'required|string|max:255',
            'postal' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'build' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->postal = $request->postal;
        $user->address = $request->address;
        $user->build = $request->build;
        $user->save();

        return redirect()->route('home')->with('success', 'プロフィールが更新されました');
        }

        return view('profile_edit', compact('user'));
    }
}
