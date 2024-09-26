<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Http\Requests\PhotoStoreRequest;
use App\Http\Requests\PhotoUpdateRequest;
use App\Models\Actions\Frame\Create;
use App\Models\Actions\Frame\Remove;
use App\Models\DataTransferObjects\Frame\CreateData;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::with('image')->latest()->get();
        return view('crm.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PhotoStoreRequest $request, Create $createImage)
    {
        $file = $request->file('photo');

        $photo = Photo::create([
            'title' => $request->input('title'),
        ]);

        $data = new CreateData(
            file: $file,
            relatable: $photo,
            owner: $request->user(),
            disk: 'public',
            directory: 'photos/images',
            type: 'image'
        );

        $createImage($data);

        return to_route('crm.photos.show', [ 'photo' => $photo->id ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return view('crm.photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return view('crm.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PhotoUpdateRequest $request, Photo $photo, Remove $deleteImage, Create $createImage)
    {
        $photo->title = $request->input('title');
        $photo->save();

        $file = $request->file('photo');

        if(!$file) return to_route('crm.photos.show', [ 'photo' => $photo->id ]);

        $image = $photo->image;

        if ($image) {
            $deleteImage($image);
        }

        $data = new CreateData(
            file: $file,
            relatable: $photo,
            owner: $request->user(),
            disk: 'public',
            directory: 'photos/images',
            type: 'image'
        );

        $createImage($data);

        return to_route('crm.photos.show', [ 'photo' => $photo->id ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('crm.photos.index');
    }
}
