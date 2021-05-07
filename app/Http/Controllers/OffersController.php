<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function index()
    {

    }

    public function offer()
    {
        $products = Products::all();

        return view('offer')->with('products', $products);
    }
}
