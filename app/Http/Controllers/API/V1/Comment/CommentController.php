<?php

namespace App\Http\Controllers\API\V1\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use function auth;
use App\Models\Post;

class CommentController extends Controller
{

    public function index(Post $post,Request $request)
    {
        return $post->comments;
        //return Comment::where('post_id', $request->post);
//        return Comment::with(['post', 'user' => function ($query) use ($request) {
//            $query->where('post_id', $post->id);
//        }])->get();

    }


    public function store(Post $post,Request $request)
    {
        $fields = $request->validate([
            'body' => 'required|string|max:255'
        ]);

        $comment=auth()->user()->comments()->create([
            'post_id' => $post->id,
            'body' => $fields['body']
        ]);

        return response($comment, 201);
    }

}
