<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Posts;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Slideshow;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function index()
    {
        $slideshow = Slideshow::all();
        $latestPosts = Posts::latest()->limit(3)->get();
        $relatedProducts = Products::latest()->limit(4)->get();

        $contactEmail = Settings::where('key', 'contact_email')->first();
        $contactPhone = Settings::where('key', 'contact_phone')->first();
        $shippingContent = Settings::where('key', 'shipping_short_content')->first();

        $email = '';
        $phone = '';
        $shipping = '';

        if ($contactEmail && $contactPhone && $shippingContent) {
            $email = $contactEmail->value;
            $phone = $contactPhone->value;
            $shipping = $shippingContent->value;
        }

        return view('index')
            ->with('slideshow', $slideshow)
            ->with('relatedProducts', $relatedProducts)
            ->with('latestPosts', $latestPosts)
            ->with('email', $email)
            ->with('phone', $phone)
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
}
