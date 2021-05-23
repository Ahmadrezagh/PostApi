<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isSuperAdmin() || Auth::user()->can('GetPosts'))
        {
            $posts = Post::query()->latest()->get();
            return response()->json(PostResource::collection($posts),200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
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

        if(Auth::user()->isSuperAdmin() || Auth::user()->can('GetPosts'))
        {
            $request->validate([
                '_title' => 'required',
                '_content' => 'required'
            ]);
            $post = Post::create([
                'title' => $request->_title,
                'content' => $request->_content
            ]);
            return response()->json([
                'postId' => $post->id,
                'message' => 'Post created successfully'
            ],200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->isSuperAdmin() || Auth::user()->can('GetPost'))
        {
            $post = Post::find($id);
            if($post)
            {
                return response()->json(PostResource::make($post),200);
            }
            return response()->json(['error' => 'Not found'],404);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
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
        if(Auth::user()->isSuperAdmin() || Auth::user()->can('GetPosts'))
        {
           $post = Post::find($id);
           if($post)
           {
               $request->validate([
                   '_title' => 'required',
                   '_content' => 'required'
               ]);
               $post = $post->update([
                   'title' => $request->_title,
                   'content' => $request->_content
               ]);
               return response()->json([
                   'postId' => $id,
                   'message' => 'Post updated successfully'
               ],200);
           }
            return response()->json(['error' => 'Not found'], 401);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->isSuperAdmin() || Auth::user()->can('GetPost'))
        {
            $post = Post::find($id);
            if($post)
            {
                $post->delete();
                return response()->json(['message' => 'Post deleted successfully'],200);
            }
            return response()->json(['error' => 'Not found'],404);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
