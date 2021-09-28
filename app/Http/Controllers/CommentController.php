<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{

    public function store(Post $post, StoreCommentRequest $request)
    {
        $attribute = array_merge($request->validated(), ['user_id' => Auth::id()]);
        $post->comments()->create($attribute);

        return response()->json([
            'message' => 'comment has been saved',
        ], 201);
    }

}
