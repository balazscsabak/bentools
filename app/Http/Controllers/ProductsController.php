<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Variants;
use Cocur\Slugify\Slugify;
use Exception;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::where('deleted', false)->get();

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
            'featured_image' => ['integer'],
            'category' => ['integer'],
            'unit' => ['integer'],
        ]);

        try {

            $variants = json_decode($request->input('variants'), true);

            foreach ($variants as $variant) {
                $checkVariantCode = Variants::where('sku', $variant['code'])->get();

                if (!$checkVariantCode->isEmpty()) {
                    return back()->withInput()
                        ->with('error', 'A termékkód már foglalt!');
                }
            }

            $slugify = new Slugify();
            $newProduct = new Products();

            $newProduct->name = $request->input('name');
            $newProduct->category_id = $request->input('category');
            $newProduct->category_image_id = $request->input('category_image');
            $newProduct->slug = $slugify->slugify($request->input('name'));
            $newProduct->description = $request->input('description');
            $newProduct->featured_image = $request->input('featured_image');
            $newProduct->has_variant = true;
            $newProduct->unit = $request->unit;
            $newProduct->save();

            foreach ($variants as $variant) {

                $newVariant = new Variants();

                $newVariant->product_id = $newProduct->id;
                $newVariant->sku = $variant['code'];
                $newVariant->price = $variant['price'];
                $newVariant->attr = json_encode($variant['attr']);
                $newVariant->attr_values = json_encode($variant['attr_values']);
                $newVariant->image_href = isset($variant['image_href']) && $variant['image_href'] !== '' ? $variant['image_href'] : '/storage/images/default-product.png';

                $newVariant->save();
            }

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
        if (!is_numeric($id)) {
            return redirect()->route('products.index');
        }

        $product = Products::find($id);

        if (!$product || !!$product->deleted) {
            return redirect()->route('products.index');
        }

        $categories = Categories::all();

        $productVariants = Variants::where([
            ['product_id', $product->id],
            ['deleted', false],
        ])->get();

        $variants = [];
        $variants['attributes'] = [];
        $variants['items'] = [];

        if (!$productVariants->isEmpty()) {
            $attributes = json_decode($productVariants[0]->attr);

            foreach ($attributes as $attr) {
                $variants['attributes'][] = $attr;
            }
        }

        foreach ($productVariants as $variant) {
            $data = [
                'id' => $variant->id,
                'image_href' => $variant->image_href,
                'attr_values' => json_decode($variant->attr_values),
                'price' => $variant->price,
                'sku' => $variant->sku,
                'active' => $variant->active
            ];

            $variants['items'][] = $data;
        }

        return view('admin.products.show')
            ->with('product', $product)
            ->with('variants', $variants)
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
        // TODO delete me
        // dd($request->input(), json_decode($request->input('variants'), true));

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'featured_image' => ['integer'],
            'category' => ['integer'],
            'unit' => ['integer'],
        ]);

        try {

            $product = Products::find($id);

            if (!$product) {
                abort(404);
            }

            $slugify = new Slugify();

            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->featured_image = $request->input('featured_image');
            $product->category_image_id = $request->input('category_image');
            $product->category_id = $request->input('category');
            $product->slug = $slugify->slugify($request->input('name'));
            $product->available = $request->available ? true : false;
            $product->unit = intval($request->unit);
            
            $product->save();

            $oldVariantIds = [];

            foreach ($product->variants as $variant) {
                $oldVariantIds[] = $variant['id'];
            }

            $variants = json_decode($request->input('variants'), true);

            foreach ($variants as $variant) {
                if (isset($variant['variant_id']) && $variant['variant_id'] !== '') {
                    $oldVariant = Variants::find($variant['variant_id']);

                    /**
                     * TODO
                     *  - validation data
                     *  - unique sku
                     */
                    $oldVariant->price = $variant['price'];
                    $oldVariant->image_href = isset($variant['image_href']) && $variant['image_href'] !== '' ? $variant['image_href'] : '/storage/images/default-product.png';
                    $oldVariant->sku = $variant['code'];
                    $oldVariant->attr = json_encode($variant['attr']);
                    $oldVariant->attr_values = json_encode($variant['attr_values']);
                    $oldVariant->active = $variant['active'] ? true : false;

                    $oldVariant->save();

                    if (($key = array_search($oldVariant->id, $oldVariantIds)) !== false) {
                        unset($oldVariantIds[$key]);
                    }

                } else {
                    $newVariant = new Variants();

                    /**
                     * TODO
                     *  - validation data
                     *  - unique sku
                     */
                    $newVariant->product_id = $product->id;
                    $newVariant->price = $variant['price'];
                    $newVariant->image_href = isset($variant['image_href']) && $variant['image_href'] !== '' ? $variant['image_href'] : '/storage/images/default-product.png';
                    $newVariant->sku = $variant['code'];
                    $newVariant->attr = json_encode($variant['attr']);
                    $newVariant->attr_values = json_encode($variant['attr_values']);

                    $newVariant->save();
                };
            }

            foreach ($oldVariantIds as $oldVariant) {
                $deletedVariant = Variants::find($oldVariant);

                $deletedVariant->deleted = true;
                $deletedVariant->save();
            }

            return back()->with('success', 'Termék sikeresen módosítva!');

        } catch (Exception $e) {
            // TODO comment me out
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

            $product = Products::find($id);
            $variants = Variants::where('product_id', $id)->get();

            foreach ($variants as $variant) {
                $variant->deleted = true;
                $variant->save();
            }

            $product->deleted = true;
            $product->save();

            return redirect()->route('products.index')->with('success', 'Termék sikeresen törölve!');
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Hiba a termék törlése során!');
        }
    }

    public function product(Request $request, $slug)
    {
        $product = Products::where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }

        $variants = Variants::where([
            ['product_id', $product->id],
            ['deleted', false],
        ])->get();

        if (count($variants) < 1) {
            abort(404);
        }

        $attributes = [];

        foreach (json_decode($variants[0]->attr) as $attr) {
            $attributes[] = $attr;
        }

        return view('products.product')
            ->with('variants', $variants)
            ->with('attributes', $attributes)
            ->with('product', $product);

    }

    public function products()
    {
        $products = Products::where([['deleted', false]])->get();
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

        if ((int) $filterCategory > 1) {
            $products = Products::with('featuredImage')->where([        
                ['name', 'LIKE', '%' . $filterName . '%'],
                ['deleted', false],
                ['category_id', $filterCategory],
            ])->get();
        } else {
            $products = Products::with('featuredImage')->where([
                ['name', 'LIKE', '%' . $filterName . '%'],
                ['deleted', false],
            ])->get();
        }

        return response()->json([
            'products' => $products,
            'status' => true,
        ]);
    }

    public function productsByCategory(Request $request, $slug) 
    {
        $category = Categories::where('slug', $slug)->first();

        if(!$category) {
            abort(404);
        }

        $products = Products::where([['category_id', $category->id], ['deleted', false]])->get();

        return view('products.products-by-bategory')
            ->with('products', $products)
            ->with('slug', $category->name);
    }
}
