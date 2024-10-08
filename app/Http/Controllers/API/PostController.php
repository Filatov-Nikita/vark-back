<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\Post\IndexResource;
use App\Http\Resources\Post\ShowResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return IndexResource::collection($posts);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new ShowResource($post);
    }

    public function other_posts(Request $request) {
        $validated = $request->validate([
            'slug' => 'required|exists:posts',
        ]);
        $posts = Post::latest()
            ->where('slug', '!=', $validated['slug'])
            ->limit(4)
            ->get();
        return IndexResource::collection($posts);
    }
}
