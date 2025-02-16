<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $user = Auth::user();

        $new_profile = $request->validated();

        if ($request->validated('password')) {
            $new_profile['password'] = bcrypt($request->validated('password'));
        }

        $user->update($new_profile);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
