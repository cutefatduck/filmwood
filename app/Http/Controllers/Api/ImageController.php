<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller 
{
    public function store(Request $request)
    {
        try {
            if ($request->hasFile("image")) {
                $fileName = md5(time().("j+'az;X<wab-wtp{.GP|9A{O&<]zq:"));
                $ext = $request->file('image')->getClientOriginalExtension();
                $url = $request->file('image')->storeAs('image', $fileName.'.'.$ext, 'privates');

                // Instanciar el modelo Image
                $image = new Image();
                $image->url = $url;
                $image->save();
            }

            $images = Image::all();
            return response()->json(['success' => true, 'images' => $images]);
        
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}