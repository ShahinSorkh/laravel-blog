<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        return Post::query()->latest()->get();
    }

    public function store(StorePostRequest $request)
    {
        $attribute = array_merge($request->validated(), ['user_id' => Auth::id()]);
        Post::create($attribute);

        return response()->json([
            'message' => 'post has been saved',
        ], 201);
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        $attribute = array_merge($request->validated(), ['user_id' => Auth::id()]);
        $post->update($attribute);

        return response()->json([
            'message' => 'post has been updated',
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'post has been deleted',
        ], 200);
    }
}
