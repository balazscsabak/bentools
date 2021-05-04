<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Slideshow;
use Exception;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settingsSlideshow()
    {
        $slideshow = Slideshow::all();

        return view('admin.slideshow')->with('slideshow', $slideshow);
    }

    public function settingsSaveSlideshow(Request $request)
    {
        try {

            Slideshow::truncate();
    
            if($request->input('slide')){
                foreach ($request->input('slide') as $slide) {
                    $newSlideShow = new Slideshow();
    
                    $newSlideShow->title = $slide['title'];
                    $newSlideShow->content = $slide['content'];
                    $newSlideShow->link_text = $slide['link_text'];
                    $newSlideShow->link_href = $slide['link_href'];
                    $newSlideShow->image = $slide['image'];

                    $newSlideShow->save();
                }
            }
            
            return back()->with('success', 'Sikeres módosítás!');

        } catch(Exception $e) {
            return back()->with('success', 'Hiba a módosítás során!');

        }
    }

    public function getImageUrlById($id)
    {
        return Media::find($id)->path;
    }
}
