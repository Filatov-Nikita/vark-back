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

class PostImageController extends Controller
{
    public function store(Request $request, string $post_id, Create $createImage) {
        $request->validate([
            'image' => 'required|image|max:1024',
        ]);

        $file = $request->file('image');

        $post = Post::findOrFail($post_id);

        $data = new CreateData(
            file: $file,
            relatable: $post,
            owner: User::firstOrFail(),
            disk: 'public',
            directory: 'posts/images',
            type: 'image'
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
            'image' => 'required|image|max:1024',
        ]);

        $file = $request->file('image');

        $post = Post::findOrFail($post_id);

        $image = $post->image;

        if ($image) {
            $deleteImage($image);
        }

        $data = new CreateData(
            file: $file,
            relatable: $post,
            owner: User::firstOrFail(),
            disk: 'public',
            directory: 'posts/images',
            type: 'image'
        );

        $createImage($data);

        return to_route('crm.posts.show', [ 'post' => $post_id ]);
    }
}
