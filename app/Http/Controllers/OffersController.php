<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\OfferItems;
use App\Models\Offers;
use App\Models\Products;
use App\Models\Settings;
use Exception;
use Illuminate\Http\Request;

class OffersController extends Controller
{

    public function index()
    {
        $offers = Offers::all();

        return view('admin.offer.offers')
            ->with('offers', $offers);
    }

    public function show(Request $request, $id)
    {
        $offer = Offers::find($id);

        return view('admin.offer.show')
            ->with('offer', $offer);
    }
    
    public function offer()
    {
        $products = Products::all();
        $offerContent = Settings::where('key', 'offer_content')->first();
        $categories = Categories::orderBy('name', 'asc')->get();
        $mainCats = [];
        $subCats = [];
        $mainCatsWithChild = [];

        foreach ($categories as $category) {
            if ($category->parent > 1) {
                $subCats[] = $category;
            } else {
                $mainCats[$category->id] = $category->name;
            }
        }

        foreach ($mainCats as $key => $value) {
            $mainCatsWithChild[$value] = [];
            $mainCatsWithChild[$value]['id'] = $key;
        }

        foreach ($subCats as $sc) {
            $mainCatsWithChild[$mainCats[$sc->parent]]['sub'][] = [
                'name' => $sc->name,
                'id' => $sc->id,
            ];
        }
        $content = '';

        if($offerContent) {
            $content = $offerContent->value;
        }

        return view('offer')
            ->with('products', $products)
            ->with('content', $content)
            ->with('mainCatsWithChild', $mainCatsWithChild);
    }

    public function store(Request $request) 
    {
        try {
            $validatedData = $request->validate([
                'full_name' => ['required', 'string'],
                'firm_name' => ['required', 'string'],
                'email' => ['required', 'email'],
                'phone_number' => ['required', 'string'],
                'items' => ['required'],
            ]);

            $newOffer = new Offers();

            $newOffer->full_name = $request->input('full_name');
            $newOffer->firm_name = $request->input('firm_name');
            $newOffer->email = $request->input('email');
            $newOffer->phone = $request->input('phone_number');
            $newOffer->message = $request->input('message');

            $newOffer->save();

            $items = $request->input('items');

            foreach ($items as $item) {
                $newItem = new OfferItems();

                $newItem->name = $item['name'];
                $newItem->quantity = $item['quantity'];
                $newItem->product_id = $item['id'];
                $newItem->offer_id = $newOffer->id;

                $newItem->save();
            }

            return back()->with('success', 'Ajánlatkérés sikeresen elküldte! Nemsokára felvesszük Önnel a kapcsolatot!');

        } catch(Exception $e) {
            return back()->with('error', 'Hiba történt az ajánlatkérés elküldése során! Kérjük vegye fel velünk a kapcsolatot!');
        }
    }

    public function offerContent()
    {
        $offerContent = Settings::where('key', 'offer_content')->first();
        $offerMessage = Settings::where('key', 'offer_message')->first();
        $offerOffer = Settings::where('key', 'offer_offer')->first();

        $content = '';
        $message = '';
        $offer = '';

        if($offerContent && $offerMessage && $offerOffer) {
            $content = $offerContent->value;
            $message = $offerMessage->value;
            $offer = $offerOffer->value;
        }

        return view('admin.offer.content')
            ->with('content', $content)
            ->with('contentMessage', $message)
            ->with('offer', $offer);
    }

    public function updateOfferContent(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'content' => ['required'],
                'content_message' => ['required'],
                'content_offer' => ['required'],
            ]);
            $offerContent = Settings::where('key', 'offer_content')->first();
            $offerMessage = Settings::where('key', 'offer_message')->first();
            $offerOffer = Settings::where('key', 'offer_offer')->first();

            $offerContent->value = $request->input('content');
            $offerContent->save();

            $offerMessage->value = $request->input('content_message');
            $offerMessage->save();

            $offerOffer->value = $request->input('content_offer');
            $offerOffer->save();

            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
