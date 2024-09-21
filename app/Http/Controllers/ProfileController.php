<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit-profile', ['admin' => $request->user(),]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $validatedData = $request->validated();

        // Check if the user needs to update their password        
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $request->user()->fill($validatedData);

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'Your Profile Has Been Updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $email = Auth::user()->email;
        $password = $request->password;
        
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = $request->user();

            Auth::logout();
    
            $user->delete();
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return Redirect::to('/admin');

        } else {
            return back()->with('error', 'The password is incorrect.');
        }
    }
}
