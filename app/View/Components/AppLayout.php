<?php

namespace App\View\Components;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Settings;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $products;
    public $categories;
    public $brochureLink = '#';

    public function __construct()
    {
        $this->categories = Categories::where('id', '!=', 1)->get()->toArray();
        $products = Products::all();
        $brochure = Settings::where('key', 'brochure_file')->first();
        
        if($brochure->value) {
            $this->brochureLink = '/storage/' . $brochure->value; 
        }

        $categories = [];
        $productsForNav = [];

        foreach ($this->categories as $cat) {
            
            $categories[$cat['id']] = $cat['name'];
        }

        foreach ($products as $product) {
            $prodId = $product->category_id;
            
            if($prodId === 1) {
                $productsForNav['uncategorized'][] = $product;  
            } else {
                $productsForNav[$categories[$product->category_id]][] = $product;
            }
        }

        $this->products = $productsForNav;
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
