<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Providers\RouteServiceProvider;
use App\Rules\PhoneNumber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', new PhoneNumber, 'unique:'.Staff::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Staff::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Staff::create([
            'full_name' => $request->full_name,
            'position' => 'Менеджер',
            'phone_number' => $request->phone_number,            
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now()
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
