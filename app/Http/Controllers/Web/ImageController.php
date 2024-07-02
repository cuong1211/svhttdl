<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $albums = Album::query()->where('type', 'photo')->latest()->get();

        return view('web.image.index', ['albums' => $albums]);
    }   
    public function show($id)
    {
        $albums = Album::query()->where('id', $id)->first()->name;
        $images = Photo::query()->where('album_id', $id)->get(); 
        // dd($images);
        return view('web.image.show', ['images' => $images, 'albums' => $albums]);
    }
}
