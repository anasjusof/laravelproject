<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\CommentReply;
use App\Comment;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);

        $replies = $comment->replies;

        //$replies = CommentReply::where('comment_id', $id)->get();

        return view('admin.comments.replies.show', compact('replies'));
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
        $input = $request->all();

        $reply = CommentReply::findOrFail($id);

        $reply->update($input);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reply = CommentReply::findOrFail($id);

        $reply->delete();

        return redirect()->back();
    }

    public function createReply(Request $request)
    {
        $user = Auth::user();

        if(!empty($user->photo->file)){
            $input = [

            'comment_id'   => $request->comment_id,
            'is_active' => $user->is_active,
            'author'    => $user->name,
            'email'     => $user->email,
            'body'      => $request->body,
            'photo'     => $user->photo->file

            ];
        }
        else{
            $input = [

            'comment_id'   => $request->comment_id,
            'is_active' => $user->is_active,
            'author'    => $user->name,
            'email'     => $user->email,
            'body'      => $request->body

            ];
        }

        $reply = CommentReply::create($input);

        return redirect()->back();
    }
}
