<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use App\Models\Orders;
use Exception;
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

    public function updateUserProfile(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');

        $user->save();

        return back()->with('success', 'Sikeres módosítás!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
            'newpassword' => ['required', 'confirmed', 'string', 'min:8'],
        ]);

        $user = Auth::user();

        $currentPassword = $user->password;

        if (!Hash::check($request->input('password'), $currentPassword)) {
            return back()->with('error', 'A régi jelszó nem egyezik!');
        }

        $user->fill([
            'password' => Hash::make($request->input('newpassword')),
        ])->save();

        return back()->with('success', 'Jelszó sikeresen módosítva!');
    }

    public function showUserProfile()
    {
        $user = Auth::user();

        return view('user.profile')
            ->with('user', $user);
    }

    public function showUserAddresses()
    {
        $user = Auth::user();
        $address = Addresses::where('user_id', $user->id)->first();

        $primary = null;
        
        if ($address && $address->default) {
            $primary = $address;
        } 

        return view('user.addresses')
            ->with('user', $user)
            ->with('primary_address', $primary);
    }

    public function showUserOrders()
    {
        $user = Auth::user();

        return view('user.orders')
            ->with('user', $user);
    }

    public function showUserOrder(Request $request, $id)
    {
        $user = Auth::user();
        $order = Orders::where([['unique_id', $id],['user_id', $user->id]])->first();
        
        if(!$order) {
            abort(404);
        }

        return view('user.order')
            ->with('user', $user)
            ->with('order', $order);
    }

    public function storeNewAddress(Request $request)
    {
        //TODO validation

        $user = Auth::user();

        try {

            $newAddress = new Addresses();

            $newAddress->user_id = $user->id;
            $newAddress->postcode = $request->input('postcode');
            $newAddress->city = $request->input('city');
            $newAddress->street = $request->input('street');

            $addresses = Addresses::where('user_id', $user->id)->count();

            if (!$addresses) {
                $newAddress->default = true;
            } 

            $newAddress->save();

            return redirect()->route('user.profile.addresses')
                ->with('success', 'Cím sikeresen létrehozva!');

        } catch (Exception $e) {
            return back()->with('error', 'Hiba történt a cím létrehozása során, kérjük próbálkozz később!');
        }
    }

    public function updateAddress(Request $request)
    {
        // TODO validation

        $user = Auth::user();

        try {

            $updateAddress = Addresses::where('user_id', $user->id)->first();

            if( ! $updateAddress ) {
                abort(404);
            }
            
            $updateAddress->user_id = $user->id;
            $updateAddress->postcode = $request->input('postcode');
            $updateAddress->city = $request->input('city');
            $updateAddress->street = $request->input('street');

            $updateAddress->default = true;
 
            $updateAddress->save();

            return redirect()->route('user.profile.addresses')
                ->with('success', 'Cím sikeresen módosítva!');

        } catch (Exception $e) {
            return back()->with('error', 'Hiba történt a cím módosítása során, kérjük próbálkozz később!');
        }
    }
}
