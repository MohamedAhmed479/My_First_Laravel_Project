<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('front.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // role
        if ($request->has("role")) {
            if ($request->role == "admin" || $request->role == "super_admin") {
                $role = $request->role;
            } else {
                return back();
            }
        } else {
            $role = "customer";
        }

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
            'rule' => $role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        if($role == "customer") {
            event(new Registered($user));

            Auth::login($user);

        }

        $dir = '';
        if(Auth::user()->rule == 'super_admin') {
            $dir = "admin.index";
            
        } else {
            $dir = "indexPage";

        }

        return to_route($dir);
    }
}
