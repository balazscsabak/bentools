<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Cocur\Slugify\Slugify;
use Exception;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();

        return view('admin.products.products')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();

        return view('admin.products.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'featured_image' => ['string'],
            'category' => ['integer'],
        ]);

        try {

            $newProduct = new Products();
            $slugify = new Slugify();

            $newProduct->name = $request->input('name');
            $newProduct->description = $request->input('description');
            $newProduct->featured_image = $request->input('featured_image');
            $newProduct->images = $request->input('images');
            $newProduct->category_id = $request->input('category');
            $newProduct->slug = $slugify->slugify($request->input('name'));

            $newProduct->save();

            $attributes = $request->input('attr');

            if ($attributes) {
                foreach ($attributes as $attribute) {
                    $newAttribute = new Attributes();

                    $newAttribute->key = $attribute['key'];
                    $newAttribute->value = $attribute['value'];
                    $newAttribute->product_id = $newProduct->id;

                    $newAttribute->save();
                }
            };

            return redirect()->route('products.index')
                ->with('success', 'Termék sikeresen létrehozva!');
        } catch (Exception $e) {
            return redirect()->route('products.index')
                ->with('error', 'Hiba a termék létrehozása során!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $product = Products::find($id);
        $categories = Categories::all();

        return view('admin.products.show')
            ->with('product', $product)
            ->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'featured_image' => ['string'],
            'category' => ['integer'],
        ]);

        try {

            $product = Products::find($id);
            $slugify = new Slugify();

            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->featured_image = $request->input('featured_image');
            $product->images = $request->input('images');
            $product->category_id = $request->input('category');
            $product->slug = $slugify->slugify($request->input('name'));

            $product->save();

            $oldAttributes = Attributes::where('product_id', $id)->get();
            $attributes = $request->input('attr');

            $oldAttributesIds = [];

            foreach ($oldAttributes as $oAttr) {
                $oldAttributesIds[] = $oAttr['id'];
            }

            if ($attributes) {
                foreach ($oldAttributesIds as $index => $oId) {
                    $contains = false;

                    foreach ($attributes as $attr) {
                        if (isset($attr['id']) && $attr['id'] == $oId) {
                            $contains = true;
                        }
                    }

                    if (!$contains) {
                        Attributes::destroy($oId);
                    }
                }
                foreach ($attributes as $attribute) {

                    if (isset($attribute['id'])) {
                        $updateAttribute = Attributes::find($attribute['id']);

                        $updateAttribute->key = $attribute['key'];
                        $updateAttribute->value = $attribute['value'];

                        $updateAttribute->save();
                        continue;
                    }

                    $newAttribute = new Attributes();

                    $newAttribute->key = $attribute['key'];
                    $newAttribute->value = $attribute['value'];
                    $newAttribute->product_id = $product->id;

                    $newAttribute->save();
                }

                return back()->with('success', 'Termék sikeresen módosítva!');
            } else {

                Attributes::destroy($oldAttributesIds);
                return back()->with('success', 'Termék sikeresen módosítva!');
            };
        } catch (Exception $e) {
            return back()->with('error', 'Hiba a termék módosítása során!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {

            $attributes = Attributes::where('product_id', $id)->get();

            foreach ($attributes as $attribute) {
                $attribute->delete();
            }

            Products::destroy($id);

            return redirect()->route('products.index')->with('success', 'Termék sikeresen törölve!');
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Hiba a termék törlése során!');
        }
    }

    public function product(Request $request, $slug)
    {
        $product = Products::where('slug', $slug)->first();
        return view('products.product')->with('product', $product);
    }

    public function products()
    {
        $products = Products::all();
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

        return view('products.products')
            ->with('mainCatsWithChild', $mainCatsWithChild)
            ->with('products', $products);
    }

    public function filter(Request $request)
    {
        $filterName = $request->input('filterName');
        $filterCategory = $request->input('filterCategory');
        
        if((int)$filterCategory > 1) {
            $products = Products::with('featuredImage')->where('name', 'LIKE', '%'.$filterName.'%')
                ->Where('category_id', $filterCategory)->get();
        } else {
            $products = Products::with('featuredImage')->where('name', 'LIKE', '%'.$filterName.'%')->get();
        }

        return response()->json([
            'products' => $products,
            'status' => true,
        ]);
    }
}
