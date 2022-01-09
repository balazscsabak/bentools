<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Errors;
use App\Models\Posts;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class FrontpageController extends Controller
{
    public function index()
    {
        $slideshow = Slideshow::all();
        $latestPosts = Posts::latest()->limit(3)->get();
        $relatedProducts = Products::where([['deleted', false], ['available', true]])->latest()->limit(4)->get();

        $contactEmail = Settings::where('key', 'contact_email')->first();
        $contactPhone = Settings::where('key', 'contact_phone')->first();
        $shippingContent = Settings::where('key', 'shipping_short_content')->first();
        $offerMessageContent = Settings::where('key', 'offer_message')->first();
        $offerOfferContent = Settings::where('key', 'offer_offer')->first();

        $email = '';
        $phone = '';
        $shipping = '';
        $offerMessage = '';
        $offerOffer = '';

        if ($contactEmail && $contactPhone && $shippingContent) {
            $email = $contactEmail->value;
            $phone = $contactPhone->value;
            $shipping = $shippingContent->value;
            $offerMessage = $offerMessageContent->value;
            $offerOffer = $offerOfferContent->value;
        }

        return view('index')
            ->with('slideshow', $slideshow)
            ->with('relatedProducts', $relatedProducts)
            ->with('latestPosts', $latestPosts)
            ->with('email', $email)
            ->with('phone', $phone)
            ->with('offerMessage', $offerMessage)
            ->with('offerOffer', $offerOffer)
            ->with('shipping', $shipping);
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

        if ($contactEmail && $contactPhone && $contactAddress && $contactMessage) {
            $email = $contactEmail->value;
            $phone = $contactPhone->value;
            $address = $contactAddress->value;
            $message = $contactMessage->value;
        }

        return view('contact')
            ->with('email', $email)
            ->with('phone', $phone)
            ->with('address', $address)
            ->with('message', $message);
    }

    public function shipping()
    {
        $shippingContent = Settings::where('key', 'shipping_content')->first();

        $content = '';

        if ($shippingContent) {
            $content = $shippingContent->value;
        }

        return view('shipping')
            ->with('content', $content);
    }

    public function aboutus()
    {
        $aboutUsContent = Settings::where('key', 'aboutus_content')->first();

        $content = '';

        if($aboutUsContent){
            $content = $aboutUsContent->value;
        }

        return view('aboutus')->with('content', $content);
    }

    public function terms()
    {
        $termsContent = Settings::where('key', 'terms_content')->first();

        $content = '';

        if($termsContent){
            $content = $termsContent->value;
        }

        return view('terms')->with('content', $content);
    }

    public function cookie()
    {
        $cookieContent = Settings::where('key', 'cookie_content')->first();

        $content = '';

        if($cookieContent){
            $content = $cookieContent->value;
        }

        return view('cookie')->with('content', $content);
    }

    public function policy()
    {
        $policyContent = Settings::where('key', 'policy_content')->first();

        $content = '';

        if($policyContent){
            $content = $policyContent->value;
        }

        return view('policy')->with('content', $content);
    }
}
