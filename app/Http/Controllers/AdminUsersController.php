<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserEditRequest;

use File;
use Session;

use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input = $request->all();

        if(!empty($input['photo_id'])){

            $file = $input['photo_id'];

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->password) == ''){

            $input = $request->except('password');

        }
        else{
            $input = $request->all();

            $input['password'] = bcrypt($input['password']);
        }
        

        if($user){

            if(!empty($input['photo_id'])){

                $file = $input['photo_id'];

                $photo_id_delete = Photo::find($user->photo_id);

                if($photo_id_delete){
                   
                   $image_path = Photo::getFileSystemDirectory($photo_id_delete->file);

                   $image_path_2 = public_path() . $photo_id_delete->file; // For linux path

                   //$image_path_2 = public_path() . $image_path; // For Window path

                   File::delete($image_path_2);

                   $photo_id_delete->delete();
                }

                $name = time() . $file->getClientOriginalName();

                $file->move('images', $name);

                $photo = Photo::create(['file'=>$name]);

                $input['photo_id'] = $photo->id;
            }

            $user->update($input);
        }

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $photo = Photo::find($user->photo_id);

        if($photo){

            $image_path_2 = public_path() . $photo->file; // For linux path

            File::delete($image_path_2);

            $photo->delete();
        }

        $user->delete();

        Session::flash('deleted_user','The user has been deleted!');

        return redirect('/admin/users');
    }
}
