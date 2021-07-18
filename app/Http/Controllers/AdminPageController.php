<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }

    public function contact()
    {
        $contactEmail = Settings::where('key', 'contact_email')->first();
        $contactPhone = Settings::where('key', 'contact_phone')->first();
        $contactAddress = Settings::where('key', 'contact_address')->first();
        $contactMessage = Settings::where('key', 'contact_message')->first();

        $email = '';
        $phone = '';
        $address = '';
        $message = '';
        
        if($contactEmail && $contactPhone && $contactAddress && $contactMessage) {
            $email = $contactEmail->value;
            $phone = $contactPhone->value;
            $address = $contactAddress->value;
            $message = $contactMessage->value;
        }
        
        return view('admin.contact')
                    ->with('email', $email)
                    ->with('phone', $phone)
                    ->with('address', $address)
                    ->with('contantMessage', $message);
    }

    public function shipping()
    {
        $shippingContent = Settings::where('key', 'shipping_content')->first();
        $shippingShortContent = Settings::where('key', 'shipping_short_content')->first();

        $content = '';
        $shortContent = '';

        if ($shippingContent && $shippingShortContent) {
            $content = $shippingContent->value;
            $shortContent = $shippingShortContent->value;
        }

        return view('admin.shipping')
            ->with('content', $content)
            ->with('shortContent', $shortContent);
    }

    public function aboutus() 
    {
        $content = Settings::where('key', 'aboutus_content')->first();

        $aboutUsContent = '';

        if($content) {
            $aboutUsContent = $content->value;
        }

        return view('admin.aboutus')->with('content', $aboutUsContent);
    }

    public function terms()
    {
        $content = Settings::where('key', 'terms_content')->first();

        $termsContent = '';

        if($content) {
            $termsContent = $content->value;
        }

        return view('admin.terms')->with('content', $termsContent);
    }

    public function policy()
    {
        $content = Settings::where('key', 'policy_content')->first();

        $policyContent = '';

        if($content) {
            $policyContent = $content->value;
        }

        return view('admin.policy')->with('content', $policyContent);
    }

    public function cookie()
    {
        $content = Settings::where('key', 'cookie_content')->first();

        $cookieContent = '';

        if($content) {
            $cookieContent = $content->value;
        }

        return view('admin.cookie')->with('content', $cookieContent);
    }
}
