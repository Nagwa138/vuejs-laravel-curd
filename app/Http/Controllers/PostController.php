<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json(['posts'=>$posts]);
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
        $validator = Validator::make($request->all(), [
            'content' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' =>false , 'errors' => $validator->errors()]);
        }
        $post = new Post();
        $post->user_id = $request->user_id;
        $post->content = $request->content;
        $post->save();

        return response()->json(['success' =>true, 'post'=>$post]);
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
        $validator = Validator::make($request->all(), [
            'content' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' =>false , 'errors' => $validator->errors()]);
        }

        $existing_post  = Post::find($id);
        if($existing_post){
            $existing_post->content = $request->content ? $request->content : $post->content;
            $existing_post->save();
            return response()->json(['success' => true , 'data' =>'Post Updated !']);

        } else{
            return response()->json(['success' => false , 'data' =>'Post Not Found !']);
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
        if(!Post::find($id)){
        return response()->json(['success' =>false]);
        }
        Post::find($id)->delete();
        return response()->json(['success' =>true]);

    }
}
