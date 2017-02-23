<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Photo;

use File;

class AdminMediaController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
    	$file = $request->file('file');

    	$name = time(). $file->getClientOriginalName();

    	$file->move('images', $name);

    	$photo = Photo::create(['file'=>$name]);

    	return redirect('/admin/media');

    }

    public function destroy($id)
    {
    	$photo = Photo::findOrFail($id);

    	$photo_path = public_path() . $photo->file;

    	File::delete($photo_path);

    	$photo->delete();

    	return redirect('/admin/media');
    }
}
