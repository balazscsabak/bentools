<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Settings;
use App\Models\Slideshow;
use Exception;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settingsSlideshow()
    {
        $slideshow = Slideshow::all();

        return view('admin.slideshow')->with('slideshow', $slideshow);
    }

    public function settingsSaveSlideshow(Request $request)
    {
        try {

            Slideshow::truncate();
    
            if($request->input('slide')){
                foreach ($request->input('slide') as $slide) {
                    $newSlideShow = new Slideshow();
    
                    $newSlideShow->title = $slide['title'];
                    $newSlideShow->content = $slide['content'];
                    $newSlideShow->link_text = $slide['link_text'];
                    $newSlideShow->link_href = $slide['link_href'];
                    $newSlideShow->image = $slide['image'];

                    $newSlideShow->save();
                }
            }
            
            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('success', 'Hiba a módosítás során!');

        }
    }

    public function getImageUrlById($id)
    {
        return Media::find($id)->path;
    }

    public function updateContact(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email'],
                'message' => ['required'],
            ]);

            $contactEmail = Settings::where('key', 'contact_email')->first();
            $contactPhone = Settings::where('key', 'contact_phone')->first();
            $contactAddress = Settings::where('key', 'contact_address')->first();
            $contactMessage = Settings::where('key', 'contact_message')->first();

            $contactEmail->value = $request->input('email');
            $contactEmail->save();

            $contactPhone->value = $request->input('phone');
            $contactPhone->save();

            $contactAddress->value = $request->input('address');
            $contactAddress->save();

            $contactMessage->value = $request->input('message');
            $contactMessage->save();

            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateShipping(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => ['required'],
                'short_content' => ['required'],
            ]);
            $shippingContent = Settings::where('key', 'shipping_content')->first();
            $shippingShortContent = Settings::where('key', 'shipping_short_content')->first();

            $shippingContent->value = $request->input('content');
            $shippingShortContent->value = $request->input('short_content');
            
            $shippingContent->save();
            $shippingShortContent->save();

            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateAboutUsContent(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => ['required'],
            ]);

            $aboutUsContent = Settings::where('key', 'aboutus_content')->first();

            $aboutUsContent->value = $request->input('content');
            $aboutUsContent->save();

            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateTermsContent(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => ['required'],
            ]);

            $termsContent = Settings::where('key', 'terms_content')->first();

            $termsContent->value = $request->input('content');
            $termsContent->save();

            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateCookieContent(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => ['required'],
            ]);

            $cookieContent = Settings::where('key', 'cookie_content')->first();

            $cookieContent->value = $request->input('content');
            $cookieContent->save();

            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updatePolicyContent(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => ['required'],
            ]);

            $policyContent = Settings::where('key', 'policy_content')->first();

            $policyContent->value = $request->input('content');
            $policyContent->save();

            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
}
