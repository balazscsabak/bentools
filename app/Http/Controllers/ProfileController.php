<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile')
                ->with('user', $user);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);

        $user = Auth::user();
        
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');

        $user->save();
        
        return back()->with('success', 'Sikeres módosítás!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
            'newpassword' => ['required', 'confirmed', 'string', 'min:8']
        ]);

        $user = Auth::user();
        
        $currentPassword = $user->password;
        
        if (!Hash::check($request->input('password'), $currentPassword)) {
            return back()->with('error', 'A régi jelszó nem egyezik!'); 
        }

        $user->fill([
            'password' => Hash::make($request->input('newpassword'))
        ])->save();

        return back()->with('success', 'Jelszó sikeresen módosítva!');
    }
}
