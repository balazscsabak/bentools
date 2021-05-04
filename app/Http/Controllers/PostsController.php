<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Posts::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="/admin/posts/' . $row->id . '" class="edit btn btn-primary">Módosítás</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.posts.posts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
            'title' => ['required'],
            'featured_image' => ['required'],
        ]);
        
        try{

            $newPosts = new Posts();
            
            $newPosts->title = $request->input('title');
            $newPosts->featured_image = $request->input('featured_image');
            $newPosts->excerpt = $request->input('excerpt');
            $newPosts->content = $request->input('content');
            
            $newPosts->save();
            
            return redirect()->route('posts.index')->with('success', 'Poszt sikeresen létrehozva!');
            
        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
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
        $post = Posts::find($id);

        return view('admin.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validatedData = $request->validate([
            'title' => ['required'],
            'featured_image' => ['required'],
        ]);
        
        try{

            $editPost = Posts::find($id);
            
            $editPost->title = $request->input('title');
            $editPost->featured_image = $request->input('featured_image');
            $editPost->excerpt = $request->input('excerpt');
            $editPost->content = $request->input('content');
            
            $editPost->save();
            
            return redirect()->route('posts.index')->with('success', 'Poszt sikeresen módosítva!');
            
        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
