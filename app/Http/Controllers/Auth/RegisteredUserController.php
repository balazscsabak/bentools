<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        // dd($request->input());

        $validation = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        // dd('stop');

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tax_number' => $request->tax_number,
            'phone_number' => $request->phone_number,
            'firm_name' => $request->firm_name,
        ]);

        $newAdress = Addresses::create([
            'user_id' => $user->id,
            'default' => true,
            'postcode' => $request->shipping_postcode,
            'county' => $request->shipping_county,
            'city' => $request->shipping_city,
            'street' => $request->shipping_street,
            'billing_postcode' => $request->billing_postcode,
            'billing_county' => $request->billing_county,
            'billing_city' => $request->billing_city,
            'billing_street' => $request->billing_street,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
