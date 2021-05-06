<?php

namespace App\View\Components;

use App\Models\Products;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $products;

    public function __construct()
    {
        $this->products = Products::all();
    }
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app');
    }
}
