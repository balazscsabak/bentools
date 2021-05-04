<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Products;
use App\Models\Slideshow;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function index()
    {
        $slideshow = Slideshow::all();
        $latestPosts = Posts::latest()->limit(3)->get();
        $relatedProducts = Products::latest()->limit(3)->get();
        
        return view('index')
                    ->with('slideshow', $slideshow)
                    ->with('relatedProducts', $relatedProducts)
                    ->with('latestPosts', $latestPosts);
    }
}
