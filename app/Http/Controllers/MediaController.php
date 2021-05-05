<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $images = Media::all();

        return view('admin.media.media')
                    ->with('images', $images);
    }

    public function upload(Request $request) 
    {
        try{

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            $imageName = time().'.'.$request->file('image')->extension();  
                
            $path = $request->image->storeAs('images', $imageName, 'public');

            $media = new Media();

            $media->name = $imageName;
            $media->path = $path;
            $media->type = 'image';

        } catch(Exception $e){
            return back()->with('error', 'Hiba történt a feldolgozásban!');
        }

        return back()->with('success', 'Sikeres feltöltés!');
    }

    public function uploadWithEditor(Request $request)
    {
        try{
            
            $imageName = time().'.'.$request->file('upload')->extension();  
                
            $path = $request->upload->storeAs('images', $imageName, 'public');

            $media = new Media();

            $media->name = $imageName;
            $media->path = $path;
            $media->type = 'image';

            if($media->save()){
                return response()->json([ 'uploaded' => true, 'fileName' => 'aki', 'url' => '/storage/'. $media->path ]);
            }

        } catch(Exception $e){
            return response()->json([ 'status' => false ]);
        }

        return response()->json([ 'status' => false ]);

    }
    public function editImage(Request $request, $id)
    {
        $image = Media::find($id);

        return view('admin.media.image')
                    ->with('image', $image);
    }

    public function delete(Request $request)
    {
        try {

            $media = Media::find($request->input('id'));
    
            $deleteMedia = Storage::disk('public')->delete($media->path);

            $media->delete();
        
            return redirect(route('media'))
                            ->with('success', 'Sikeres törlés!');

        } catch(Exception $e){
            return back()
                        ->with('error', 'Hiba a törlés során!');
        }
    }

    public function getImages(){
        $images = Media::all();
        
        return response()->json($images);
    }
}
