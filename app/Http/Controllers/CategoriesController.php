<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Cocur\Slugify\Slugify;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Categories::orderBy('parent', 'asc')->get();

        $catArray = [];

        foreach ($categories as $category) {
            
            if($category->parent === 1){

                $catArray[$category->id]['name'] = $category->name;

            } else {

                $catArray[$category->parent]['sub'][] = [
                    'id' => $category->id,
                    'name' => $category->name
                ];

            }
        }
        
        return view('admin.categories.categories')->with('categories', $catArray);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainCategories = Categories::where('parent', 1)->get();

        return view('admin.categories.create')->with('mainCategories', $mainCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $newCategory = new Categories();
            $slugify = new Slugify();
 
            $newCategory->name = $request->input('name');
            $newCategory->slug = $slugify->slugify($request->input('name'));
            $newCategory->parent = $request->input('parent');
            
            $newCategory->save();
            
            return redirect()->route('categories.index')->with('success', 'Kategória sikeresen létrehozva!');
            
        } catch(Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Hiba történt a feldolgozás során!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::find($id);
        $mainCategories = Categories::where('parent', 1)->get();

        return view('admin.categories.show')
                    ->with('category', $category)
                    ->with('mainCategories', $mainCategories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        // $category = Categories::find($id);

        // return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        
        if($category->parent !== (int)$request->input('parent')){
            $editable = Categories::where('parent', $id)->count();
         
            if($editable > 0){
                return redirect()->route('categories.index')
                            ->with('error', 'Hiba, a kategóriához tartozik alkategória!');
            }       
        } 
        
        $slugify = new Slugify();

        $category->parent = $request->input('parent');
        $category->slug = $slugify->slugify($request->input('name'));

        $category->name = $request->input('name');

        $category->save();

        return redirect()->route('categories.index')
                    ->with('success', 'Sikeres módosítás!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id);

        $productsCount = Products::where('category_id', $id)->count();

        if($productsCount > 0) {
            return back()->with('error', 'A kategóriát nem lehet törölni, mivel tartozik hozzá termék!');
        } 

        $subCategoriesCount = Categories::where('parent', $id)->count();
        
        if($subCategoriesCount > 0) {
            return back()->with('error', 'A kategóriát nem lehet törölni, mivel tartozik hozzá alkategória!');
        } 

        $category->delete();

        return redirect()->route('categories.index')
                    ->with('success', 'Sikeres törlés!');
    }
}
