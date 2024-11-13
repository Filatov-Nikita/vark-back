<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Frame;
use App\Http\Requests\VideoStoreRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Models\Actions\Frame\Create;
use App\Models\Actions\Frame\Remove;
use App\Models\DataTransferObjects\Frame\CreateData;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::with('video')->latest()->get();
        return view('crm.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoStoreRequest $request, Create $createFile)
    {
        $videoFile = $request->file('video');
        $previewFile = $request->file('preview');

        $video = Video::create([
            'title' => $request->input('title'),
        ]);

        $videoData = new CreateData(
            file: $videoFile,
            relatable: $video,
            owner: $request->user(),
            disk: 'public',
            directory: 'videos',
            type: 'video'
        );

        $createFile($videoData);

        $previewData = new CreateData(
            file: $previewFile,
            relatable: $video,
            owner: $request->user(),
            disk: 'public',
            directory: 'videos/previews',
            type: 'preview'
        );

        $createFile($previewData);

        return to_route('crm.videos.show', [ 'video' => $video->id ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('crm.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('crm.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoUpdateRequest $request, Video $video, Remove $delete, Create $create)
    {
        $video->title = $request->input('title');
        $video->save();

        $videoFile = $request->file('video');
        $previewFile = $request->file('preview');

        if($videoFile) {
            $frame = $video->video;

            if ($frame) {
                $delete($frame);
            }

            $data = new CreateData(
                file: $videoFile,
                relatable: $video,
                owner: $request->user(),
                disk: 'public',
                directory: 'videos',
                type: 'video'
            );

            $create($data);
        }

        if($previewFile) {
            $frame = $video->preview;

            if ($frame) {
                $delete($frame);
            }

            $data = new CreateData(
                file: $previewFile,
                relatable: $video,
                owner: $request->user(),
                disk: 'public',
                directory: 'videos/previews',
                type: 'preview'
            );

            $create($data);
        }

        return to_route('crm.videos.show', [ 'video' => $video->id ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video, Remove $delete)
    {
        $videoFrame = $video->video;

        if($videoFrame) {
            $delete($videoFrame);
        }

        $previewFrame = $video->preview;

        if($previewFrame) {
            $delete($previewFrame);
        }

        $video->delete();

        return redirect()->route('crm.videos.index');
    }
}
