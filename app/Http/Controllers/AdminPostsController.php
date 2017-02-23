<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostsCreateRequest;
use App\Post;
use App\Photo;
use App\Category;

use Auth;
use File;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();

        $user = Auth::user();

        $input['user_id'] = $user->id;

        if(!empty($input['photo_id'])){

            $file = $input['photo_id'];

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $post = Post::create($input);

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::lists('name', 'id')->all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post', 'categories'));
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
        $input = $request->all();

        $post = Post::findOrFail($id);

        if(!empty($input['photo_id'])){

            if($post->photo_id != 0){

               $photo_delete = Photo::find($post->photo->id);

               $image_path_old = $post->photo->file;

               $image_path_2 = public_path() . $image_path_old; // For linux path

               //$image_path_2 = public_path() . $image_path; // For Window path

               File::delete($image_path_2);

               $photo_delete->delete();
            }


            $file = $input['photo_id'];

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }
        // Auth::user()->posts()->whereId($id)->first()->update($input);
        $post->update($input);

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $image_to_be_delete_path = $post->photo->file;

        if($image_to_be_delete_path){

            $image_to_be_delete_path_with_public_path = public_path() . $image_to_be_delete_path;

            File::delete($image_to_be_delete_path_with_public_path);

            $photo = Photo::findOrFail($post->photo->id);

            $photo->delete();
        }

        $post->delete();

        return redirect('/admin/posts');
    }

    public function post($id){

        $post = Post::findOrFail($id);

        return view('post', compact('post'));
    }
}
