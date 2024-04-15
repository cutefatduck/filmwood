<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller 
{

    public function store (Request $request){
        // Script para subir la imagen
        if($request->hasFile("image")){
            $fileName = md5(time().("j+'az;X<wab-wtp{.GP|9A{O&<]zq:"));
            $ext = $request->file('image')->getClientOriginalExtension();
            $url = $request->file('image')->storeAs('image',$fileName.'.'.$ext,'privates');
            $image->url = $url;
            $image->save();
        }

        $images = Image::all();
        return view('welcome',compact('images'));
    }

    public function getImage($image){

        $path = storage_path('app/private/image/'.$image);
        return response()->file ($path);
    }

}