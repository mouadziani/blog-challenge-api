<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->with('user')
            ->latest()
            ->paginate();

        return PostResource::collection($posts);
    }

    public function store(CreateRequest $request)
    {
        $user = auth()->user();
        $post = $user->posts()->create($request->validated());

        return new PostResource($post);
    }

    public function show(Post $post)
    {
        $post->load('user');

        return new PostResource($post);
    }

    public function update(Post $post, UpdateRequest $request)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return new PostResource($post);
    }
}
