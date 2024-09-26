<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Post;
use App\Models\Actions\Frame\Create;
use App\Models\Actions\Frame\Remove;
use App\Models\DataTransferObjects\Frame\CreateData;
use App\Models\User;

class PostThumbnailController extends Controller
{
    public function store(Request $request, string $post_id, Create $createImage) {
        $request->validate([
            'thumbnail' => 'required|image|max:1024',
        ]);

        $file = $request->file('thumbnail');

        $post = Post::findOrFail($post_id);

        $data = new CreateData(
            file: $file,
            relatable: $post,
            owner: User::firstOrFail(),
            disk: 'public',
            directory: 'posts/thumbnails',
            type: 'thumbnail'
        );

        $createImage($data);

        return to_route('crm.posts.show', [ 'post' => $post_id ]);
    }

    public function update(
        Request $request,
        string $post_id,
        Remove $deleteImage,
        Create $createImage,
    ) {
        $request->validate([
            'thumbnail' => 'required|image|max:1024',
        ]);

        $file = $request->file('thumbnail');

        $post = Post::findOrFail($post_id);

        $image = $post->thumbnail;

        if ($image) {
            $deleteImage($image);
        }

        $data = new CreateData(
            file: $file,
            relatable: $post,
            owner: User::firstOrFail(),
            disk: 'public',
            directory: 'posts/thumbnails',
            type: 'thumbnail'
        );

        $createImage($data);

        return to_route('crm.posts.show', [ 'post' => $post_id ]);
    }
}
