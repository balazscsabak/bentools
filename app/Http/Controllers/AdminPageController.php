<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\Categories;
use App\Models\User;
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

    public function users()
    {
        $users = User::all();
        return view('admin.users.showUsers')->with('users', $users);
    }
    public function showUser(Request $request, $id)
    {
        if($id < 1 || !is_numeric($id)) {
            abort(404);
        }

        $user = User::find($id);

        if(!$user) {
            abort(404);
        }

        return view('admin.users.showUser')->with('user', $user);
    }

    public function updateAbleTo30(Request $request) 
    {
        $id = $request->id;
        $ableTo30 = $request->able_to_30;
        
        if($id < 1) {
            abort(404);
        }

        $user = User::find($id);

        if(!$user) {
            abort(404);
        }
        
        $user->able_to_30 = $ableTo30 ? true : false;
        $user->save();
        
        return back()->with('success', 'Sikeres módosítás!');
    }

    public function featuredCategories(Request $request)
    {
        $categories = Categories::all();
        $featured = Settings::where('key', 'frontpage_feat_categories')->first();

        return view('admin.categories.featured')->with('categories', $categories)->with('featured', json_decode($featured->value));
    }

    public function updateFeaturedCategories(Request $request)
    {
        Settings::where('key', 'frontpage_feat_categories')->update([
            'value' => $request->input('featuredCategories')
        ]);
     
        return back()->with('success', 'Sikeres módosítás!');
    }
}
